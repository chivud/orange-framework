<?php
namespace Core;

use Core\Http\RequestInterface;
use Core\Route\Route;
use Core\Exceptions\RouteNotExistsException;
use Core\Services\Config;

class Kernel
{
    const BASE_NAMESPACE = 'App\Controllers\\';

    protected $request;
    protected $route;

    public function __construct(RequestInterface $request, Route $route)
    {
        $this->request = $request;
        $this->route = $route;
    }

    public function dispatch()
    {
        $path = $this->route->getRoute($this->request->method, $this->request->path);
        if (!$path) {
            throw new RouteNotExistsException($this->request->method . ' ' . $this->request->path . ' resource does not exists.');
        }

        $className = self::BASE_NAMESPACE . $path['controller'];
        if(class_exists($className)){
            $response = $this->runMethod($className, $path['method']);
        }
    }

    private function runMethod($className, $method)
    {
        $requestedClass = new $className;

        if (method_exists($requestedClass, $method) && is_callable([$requestedClass, $method])) {
            return $requestedClass->{$method}();
        }
    }

}