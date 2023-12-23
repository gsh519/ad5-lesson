<?php

declare(strict_types=1);

$dsn = 'mysql:host=mysql;dbname=ad5_lesson;charset=utf8mb4';
$user = 'root';
$password = 'password';

// PDO接続
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    // エラーログに記録
    exit($e->getMessage());
}
