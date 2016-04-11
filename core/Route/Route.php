<?php


namespace Core\Route;

use Core\Exceptions\InvalidRouteException;

class Route
{
    public static $get;

    public static $post;

    public static $put;

    public static $patch;

    public static $delete;

    public static function get($url, $controller)
    {
        self::processUrl($url, 'get', $controller);
    }

    public static function post($url, $controller)
    {
        self::processUrl($url, 'post', $controller);
    }

    public static function put($url, $controller)
    {
        self::processUrl($url, 'put', $controller);
    }

    public static function patch($url, $controller)
    {
        self::processUrl($url, 'patch', $controller);
    }

    public static function delete($url, $controller)
    {
        self::processUrl($url, 'delete', $controller);
    }

    private static function processUrl($url, $method, $controller)
    {
        self::${$method}[$url !== '/' ? ltrim($url, '/') : '/'] = self::processControllerMethod($controller);
    }

    private static function processControllerMethod($controller)
    {
        $explodedController = explode('@', $controller);

        if (is_array($explodedController) && count($explodedController) === 2) {
            return [
                'controller' => $explodedController[0],
                'method' => $explodedController[1]
            ];
        }

        throw new InvalidRouteException('Route ' . $controller . ' is invalid');
    }

    public function getRegisteredRoutes()
    {
        return [
            'get' => self::$get,
            'post' => self::$post,
            'put' => self::$put,
            'patch' => self::$patch,
            'delete' => self::$delete,
        ];
    }

    public function getRoute($httpVerb, $path)
    {
        $path = $this->processRequestedPath($path);

        if (property_exists($this, strtolower($httpVerb))) {
            return isset(self::${strtolower($httpVerb)}[$path]) ? self::${strtolower($httpVerb)}[$path] : null;
        }

        return null;
    }

    private function processRequestedPath($path)
    {
        if ($path != '/') {
            $path = ltrim($path, '/');
        }
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        if($path == ''){
            $path = '/';
        }

        return $path;
    }
}
