<?php

declare(strict_types=1);

require('./bootstrap/init.php');
require('./helpers/dump.php');
require('./Requests/Employee/CreateRequest.php');
require('./enums/gender.php');

class EmployeeCreateController
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

    public function create(): void
    {
        $request = new CreateRequest($_POST);

        if (!empty($this->validate($request))) {
            // エラーを返す
            include('./resources/views/employee-create-init.view.php');
            return;
        }

        $create_sql = 'insert into employees (employee_name, employee_name_kana, gender, birthday, created_at, created_by, updated_at, updated_by, deleted_timestamp) values (:employee_name, :employee_name_kana, :gender, :birthday, :created_at, :created_by, :updated_at, :updated_by, :deleted_timestamp)';

        $now = date("Y-m-d H:i:s");
        $birthday = new DateTime($request->birthday);

        $stmt = $this->pdo->prepare($create_sql);
        $stmt->bindValue(':employee_name', $request->employee_name);
        $stmt->bindValue(':employee_name_kana', $request->employee_name_kana);
        $stmt->bindValue(':gender', $request->gender, PDO::PARAM_INT);
        $stmt->bindValue(':birthday', $birthday->format('Y-m-d H:i:s'));
        $stmt->bindValue(':created_at', $now);
        $stmt->bindValue(':created_by', '1');
        $stmt->bindValue(':updated_at', $now);
        $stmt->bindValue(':updated_by', '1');
        $stmt->bindValue(':deleted_timestamp', '0');
        $stmt->execute();

        $_SESSION['flash']['success'] = '社員を登録しました';

        header('Location:/');
    }

    /**
     * 入力値バリデーション
     *
     * @param CreateRequest $request
     * @return array<string, string>
     */
    private function validate(CreateRequest $request): array
    {
        $error_messages = [];

        if (!$request->employee_name) {
             $error_messages['employee_name'] = '氏名は必須です';
        }

        if (!$request->employee_name_kana) {
            $error_messages['employee_name_kana'] = 'かなは必須です';
        }

        if ($request->gender && !array_key_exists($request->gender, Gender::labels())) {
            $error_messages['gender'] = '性別を選択してください';
        }

        return $error_messages;
    }
}
