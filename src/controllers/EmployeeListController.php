<?php

declare(strict_types=1);

require('./bootstrap/init.php');
require('./entities/employee.php');
require('./helpers/dump.php');

class EmployeeListController
{
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
        $request = $_GET;
        $params = [];

        $base_sql = 'select * from employees where deleted_timestamp = 0';

        // 氏名
        if (isset($request['name']) && $request['name'] !== "") {
            $base_sql .= " and (employee_name like :name or employee_name_kana like :name)";
            $params[':name'] = "%{$request['name']}%";
        }

        // 性別
        if (isset($request['gender']) && $request['gender'] !== "") {
            $base_sql .= " and gender = :gender";
            $params[':gender'] = $request['gender'];
        }

        /** @var PDOStatement $stmt */
        $stmt = $this->pdo->prepare($base_sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employees = array_map(fn (array $employee) => new Employee($employee), $rows);

        include('./resources/views/employee-list.view.php');
    }
}
