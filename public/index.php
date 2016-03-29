<?php

require '../vendor/autoload.php';

use Core\Kernel;
use Core\Http\Request;

$kernel = new Kernel(
    new Request(),
    new \Core\Route\Route(),
    new \Core\Route\Dispatcher()
);

require_once '../src/route.php';

$kernel->dispatch();