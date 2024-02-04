<?php

declare(strict_types=1);

require(__DIR__ . '/controllers/Employee/ListController.php');

$controller = new ListController();
$controller->show();
