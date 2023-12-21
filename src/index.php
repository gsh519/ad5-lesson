<?php

declare(strict_types=1);

require(__DIR__ . '/bootstrap/init.php');
require(__DIR__ . '/entities/employee.php');

$sql = 'select * from employees where deleted_timestamp = 0';
/** @var \PDO $pdo */
$stmt = $pdo->query($sql);
if ($stmt === false) {
    die();
}
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$employees = array_map(fn (array $employee) => new Employee($employee), $rows);

include(__DIR__ . '/resources/views/employee-list.view.php');
