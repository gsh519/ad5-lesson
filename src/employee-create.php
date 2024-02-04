<?php

declare(strict_types=1);

require_once(__DIR__ . '/controllers/Employee/CreateController.php');

$controller = new CreateController();
if (!empty($_POST)) {
    $controller->create();
    return;
}

$controller->createInit();
