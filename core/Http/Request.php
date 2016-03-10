<?php

namespace Core\Http;


class Request implements RequestInterface
{

    protected $query;

    protected $params;

    protected $files;

    public $path;

    public $method;

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
    public function get($key = null)
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
    public function post($key = null)
    {
        if ($key) {
            return isset($this->params[$key]) ? $this->params[$key] : null;
        }

        return $this->params;
    }

}