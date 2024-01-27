<?php

declare(strict_types=1);

require('./bootstrap/init.php');
require('./helpers/dump.php');
require('./Requests/Employee/CreateRequest.php');

class EmployeeCreateInitController
{
    public function addInit(): void
    {
        $request = new CreateRequest([]);
        include('./resources/views/employee-create-init.view.php');
    }
}
