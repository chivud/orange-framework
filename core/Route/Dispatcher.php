<?php

namespace Core\Route;

use Core\Exceptions\RouteNotExistsException;
use Core\Http\RequestInterface;

class Dispatcher
{
    const BASE_NAMESPACE = 'App\Controllers\\';

    public function execute(RequestInterface $request, Route $route)
    {
        $response = null;

        $path = $route->getRoute($request->requestMethod(), $request->requestPath());
        if (!$path) {
            throw new RouteNotExistsException($request->requestMethod() . ' ' . $request->requestPath() . ' resource does not exists.');
        }

        $className = self::BASE_NAMESPACE . $path['controller'];
        if (class_exists($className)) {
            $response = $this->runMethod($className, $path['method'], $request);
        }

        return $response;
    }

    private function runMethod($className, $method, RequestInterface $request)
    {
        $requestedClass = new $className($request);

        if (method_exists($requestedClass, $method) && is_callable([$requestedClass, $method])) {
            return $requestedClass->{$method}();
        }

        return null;
    }
}
