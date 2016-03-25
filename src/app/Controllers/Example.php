<?php

namespace App\Controllers;


use Core\Controller\Controller;
use Core\Http\JsonResponse;
use Core\Http\Response;

class Example extends Controller
{
    public function index()
    {
        return new JsonResponse(['test']);
    }
}