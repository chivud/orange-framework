<?php
namespace Core;

use Core\Http\RequestInterface;
use Core\Route\Route;

class Kernel
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function dispatch()
    {

    }
}