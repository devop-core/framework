<?php
use DevOp\Core\Application;

include_once '../vendor/autoload.php';

Application::make()->configure()->process()->end();
