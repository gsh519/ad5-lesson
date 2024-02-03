<?php

declare(strict_types=1);

require_once(__DIR__ . '/controllers/Employee/UpdateController.php');

$controller = new UpdateController();
if (!empty($_POST)) {
    $controller->update();
    return;
}

$controller->editInit();
