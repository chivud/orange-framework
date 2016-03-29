<?php
namespace Core;

use Core\Exceptions\InvalidResponseException;
use Core\Http\RequestInterface;
use Core\Http\ResponseInterface;
use Core\Route\Dispatcher;
use Core\Route\Route;

/**
 * Main class that boots the application
 * @package Core
 */
class Kernel
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var Route
     */
    protected $route;

    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Kernel constructor.
     * @param RequestInterface $request
     * @param Route $route
     * @param Dispatcher $dispatcher
     */
    public function __construct(RequestInterface $request, Route $route, Dispatcher $dispatcher)
    {
        $this->request = $request;
        $this->route = $route;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Dispatch any requested methods
     * @throws Exceptions\RouteNotExistsException
     * @throws InvalidResponseException
     */
    public function dispatch()
    {
        $response = $this->dispatcher->execute($this->request, $this->route);

        if (!is_object($response) || !$response instanceof ResponseInterface) {
            throw new InvalidResponseException('Invalid response. You must always return a ResponseInterface object from the controller');
        }

        $response->send();

    }


}