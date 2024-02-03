<?php

declare(strict_types=1);

require_once('./bootstrap/init.php');
require_once('./helpers/dump.php');
require_once('./Requests/Employee/UpdateRequest.php');
require_once('./Requests/Employee/UpdateInitRequest.php');
require_once('./entities/employee.php');

class UpdateController
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

    /**
     * 社員編集画面初期表示
     *
     * @return void
     */
    public function editInit(): void
    {
        // idから社員取得
        $request = new UpdateInitRequest($_GET);
        if ($request->employee_id === null) {
            $_SESSION['flash']['error'] = 'URLが間違えています。';
            header("Location:/");
        }

        $sql = 'select * from employees where employee_id = :employee_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':employee_id', $request->employee_id, PDO::PARAM_INT);
        $stmt->execute();
        /** @var array<string, int|string> */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $employee = new Employee($row);

        include('./resources/views/employee-edit.view.php');
    }

    /**
     * 社員編集処理
     *
     * @return void
     */
    public function update(): void
    {
        $request = new UpdateRequest($_POST);
        if ($this->isInvalid($request)) {
            $error_messages = $_SESSION['flash']['input_errors'];
            $original = $_POST;

            // エラーを返す
            include('./resources/views/employee-edit.view.php');
            return;
        }

        $update_sql = 'update employees set employee_name = :employee_name, employee_name_kana = :employee_name_kana, gender = :gender, birthday = :birthday, created_at = :created_at, created_by = :created_by, updated_at = :updated_at, updated_by = :updated_by, deleted_timestamp = :deleted_timestamp where employee_id = :employee_id';

        $now = date("Y-m-d H:i:s");

        $stmt = $this->pdo->prepare($update_sql);
        $stmt->bindValue(':employee_name', $request->employee_name);
        $stmt->bindValue(':employee_name_kana', $request->employee_name_kana);
        $stmt->bindValue(':gender', $request->gender, PDO::PARAM_INT);
        $stmt->bindValue(':birthday', $request->birthday);
        $stmt->bindValue(':created_at', $now);
        $stmt->bindValue(':created_by', 1, PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', $now);
        $stmt->bindValue(':updated_by', 1, PDO::PARAM_INT);
        $stmt->bindValue(':deleted_timestamp', 0, PDO::PARAM_INT);
        $stmt->bindValue(':employee_id', $request->employee_id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['flash']['success'] = '社員を編集しました';

        header("Location:/employee-edit.php?employee_id={$request->employee_id}");
    }

    /**
     * 入力値バリデーション
     * 不正の場合trueを返す
     *
     * @param UpdateRequest $request
     * @return bool
     */
    private function isInvalid(UpdateRequest $request): bool
    {
        $is_invalid = false;

        if (!$request->employee_name) {
            $_SESSION['flash']['input_errors']['employee_name'] = '氏名は必須です';
            $is_invalid = true;
        }

        if (!$request->employee_name_kana) {
            $_SESSION['flash']['input_errors']['employee_name_kana'] = 'かなは必須です';
            $is_invalid = true;
        }

        if ($request->gender && !array_key_exists($request->gender, Gender::labels())) {
            $_SESSION['flash']['input_errors']['gender'] = '性別を選択してください';
            $is_invalid = true;
        }

        return $is_invalid;
    }
}
