<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

use DevOp\Core\Framework\Application;

include_once '../vendor/autoload.php';

Application::make()
    ->configure()
    ->process()
    ->terminate();
