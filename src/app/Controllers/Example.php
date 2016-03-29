<?php

namespace App\Controllers;


use Core\Controller\Controller;

class Example extends Controller
{
    public function index()
    {
        return $this->view('index');
    }
}