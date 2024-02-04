<?php

declare(strict_types=1);

require_once(__DIR__ . '/../BaseController.php');
require_once(__DIR__ . '/../../entities/employee.php');
require_once(__DIR__ . '/../../entities/Paginate.php');
require_once(__DIR__ . '/../../Requests/Employee/FetchRequest.php');

class ListController extends BaseController
{
    private const DEFAULT_PER_PAGE = 5;

    public function show(): void
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $request = new FetchRequest($_GET);
        $search_params = [];
        $query_parameter = [];

        $base_sql = 'select * from employees where deleted_timestamp = 0';

        // 氏名
        if ($request->name) {
            $base_sql .= " and (employee_name like :name or employee_name_kana like :name)";
            $search_params[':name'] = "%{$request->name}%";
            $query_parameter['name'] = $request->name;
        }

        // 性別
        if ($request->gender) {
            $base_sql .= " and gender = :gender";
            $search_params[':gender'] = $request->gender;
            $query_parameter['gender'] = $request->gender;
        }

        // 総件数
        $stmt = $this->pdo->prepare($base_sql);
        $stmt->execute($search_params);
        $total_count = count($stmt->fetchAll(PDO::FETCH_ASSOC));

        $offset = ($page - 1) * self::DEFAULT_PER_PAGE;
        $base_sql .= ' order by employee_id desc';
        $base_sql .= sprintf(' limit %d offset %d', self::DEFAULT_PER_PAGE, $offset);

        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare($base_sql);
        $stmt->execute($search_params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employees = array_map(fn (array $employee) => new Employee($employee), $rows);

        // ページネーション
        $paginate = new Paginate($total_count, $page);
        $paginate->setQueryParametor($query_parameter);

        global $flash;

        include('./resources/views/employee-list.view.php');
    }
}
