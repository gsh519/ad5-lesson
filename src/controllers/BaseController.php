<?php

declare(strict_types=1);

require_once(__DIR__ . '/../bootstrap/init.php');
require_once(__DIR__ . '/../helpers/dump.php');


class BaseController
{
    protected PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }
}
