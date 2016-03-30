<?php

namespace Core\Http;

class Request implements RequestInterface
{

    /**
     * GET params
     * @var array
     */
    protected $query;

    /**
     * POST Params
     * @var array
     */
    protected $params;

    /**
     * FILES params
     * @var array
     */
    protected $files;

    /**
     * Request path
     * @var string
     */
    protected $path;

    /**
     * Request method
     * @var string
     */
    protected $method;

    /**
     * Initialize request object with request variables
     */
    public function __construct()
    {
        $this->query = $_GET;
        $this->params = $_POST;
        $this->files = $_FILES;
        $this->path = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param mixed $key
     * @return mixed
     */
    public function query($key = null)
    {
        if ($key) {
            return isset($this->query[$key]) ? $this->query[$key] : null;
        }

        return $this->query;
    }

    /**
     * @param mixed $key
     * @return mixed
     */
    public function input($key = null)
    {
        if ($key) {
            return isset($this->params[$key]) ? $this->params[$key] : null;
        }

        return $this->params;
    }

    /**
     * Return the HTTP request method
     * @return string
     */
    public function requestMethod()
    {
        return $this->method;
    }

    /**
     * Return HTTP request path
     * @return string
     */
    public function requestPath()
    {
        return $this->path;
    }
}
