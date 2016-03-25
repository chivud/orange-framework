<?php
namespace Core;

use Core\Exceptions\InvalidResponseException;
use Core\Http\RequestInterface;
use Core\Http\ResponseInterface;
use Core\Route\Dispatcher;
use Core\Route\Route;
use Core\Exceptions\RouteNotExistsException;
use Core\Services\Config;

class Kernel
{

    protected $request;
    protected $route;
    protected $dispatcher;

    public function __construct(RequestInterface $request, Route $route, Dispatcher $dispatcher)
    {
        $this->request = $request;
        $this->route = $route;
        $this->dispatcher = $dispatcher;
    }

    public function dispatch()
    {
        $response = $this->dispatcher->execute($this->request, $this->route);

        if (!is_object($response) || !$response instanceof ResponseInterface) {
            throw new InvalidResponseException('Invalid response. You must always return a ResponseInterface object from the controller');
        }

        $response->send();

    }


}