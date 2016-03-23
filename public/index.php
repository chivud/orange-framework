<?php


require '../vendor/autoload.php';

use Core\Kernel;
use Core\Http\Request;

$request = new Request();
$kernel = new Kernel($request, new \Core\Route\Route());

require_once '../src/route.php';

$kernel->dispatch();