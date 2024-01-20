<?php

declare(strict_types=1);

require('./bootstrap/init.php');
require('./entities/employee.php');
require('./helpers/dump.php');
require('./Requests/Employee/FetchRequest.php');

class EmployeeListController
{
    private const DEFAULT_PER_PAGE = 5;
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=mysql;dbname=ad5_lesson;charset=utf8mb4';
        $user = 'root';
        $password = 'password';

        // PDO接続
        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            // エラーログに記録
            exit($e->getMessage());
        }
    }
    public function show(): void
    {
        $_GET['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $request = new FetchRequest($_GET);
        $search_params = [];

        $base_sql = 'select * from employees where deleted_timestamp = 0';
        $total_count_sql = 'select count(*) as total_count from employees where deleted_timestamp = 0';

        // 氏名
        if ($request->name) {
            $base_sql .= " and (employee_name like :name or employee_name_kana like :name)";
            $total_count_sql .= " and (employee_name like :name or employee_name_kana like :name)";
            $search_params[':name'] = "%{$request->name}%";
        }

        // 性別
        if ($request->gender) {
            $base_sql .= " and gender = :gender";
            $total_count_sql .= " and gender = :gender";
            $search_params[':gender'] = $request->gender;
        }

        $offset = ($request->page - 1) * self::DEFAULT_PER_PAGE;
        $base_sql .= sprintf(' limit %d offset %d', self::DEFAULT_PER_PAGE, $offset);

        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare($base_sql);
        $stmt->execute($search_params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employees = array_map(fn (array $employee) => new Employee($employee), $rows);

        // ページネーション
        $paginate = [];
        // 総件数
        $stmt = $this->pdo->prepare($total_count_sql);
        $stmt->execute($search_params);
        /** @var int $total_count */
        $paginate['total_count'] = $stmt->fetchColumn();

        // ページ数
        $paginate['page_count'] = (int)ceil($paginate['total_count'] / self::DEFAULT_PER_PAGE);

        // from, to
        $paginate['from'] = $offset + 1;
        $paginate['to'] = $request->page * self::DEFAULT_PER_PAGE;

        if ($paginate['to'] > $paginate['total_count']) {
            $paginate['to'] = $paginate['total_count'];
        }

        include('./resources/views/employee-list.view.php');
    }
}
