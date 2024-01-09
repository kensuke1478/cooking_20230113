<?php

namespace App\Controllers;

use App\Models\ModelTest;

class ControllerTest
{
    public function run()
    {
        $model = new ModelTest();
        echo $model->getHello();
    }
}
