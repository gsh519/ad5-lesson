<?php

declare(strict_types=1);

require(__DIR__ . '/controllers/EmployeeCreateInitController.php');

$controller = new EmployeeCreateInitController();
$controller->addInit();
