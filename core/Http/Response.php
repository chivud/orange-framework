<?php

namespace Core\Http;


class Response implements ResponseInterface
{

    protected $response;

    public function __construct($response = null)
    {
        $this->response = $response;
    }

    public function returnResponse()
    {
        return $this->response;
    }
}