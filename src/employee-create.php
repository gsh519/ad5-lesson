<?php

declare(strict_types=1);

require(__DIR__ . '/controllers/EmployeeCreateController.php');

$controller = new EmployeeCreateController();
$controller->create();
