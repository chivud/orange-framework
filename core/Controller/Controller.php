<?php

namespace Core\Controller;


use Core\Http\RequestInterface;

class Controller
{
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    protected function getRequest()
    {
        return $this->request;
    }
}