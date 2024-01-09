<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use App\Controllers\ControllerTest;
$app = new ControllerTest();
$app->run();
