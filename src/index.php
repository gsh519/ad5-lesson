<?php

declare(strict_types=1);

require(__DIR__ . '/controllers/EmployeeListController.php');

$controller = new EmployeeListController();
$controller->show();
