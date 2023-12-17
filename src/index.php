<?php

require(__DIR__ . '/bootstrap/init.php');
require(__DIR__ . '/entities/employee.php');

$sql = 'select * from employees where deleted_timestamp = 0';
$stmt = $pdo->query($sql);
if ($stmt === false) {
    die();
}
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
/** @var array<Employee> $employees */
$employees = array_map(fn (array $employee) => new Employee($employee), $rows);

include(__DIR__ . '/resources/views/employee-list.view.php');
