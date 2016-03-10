<?php

namespace Core\Http;


class JsonResponse implements ResponseInterface
{

    protected $response;

    public function __construct($response = null)
    {
        $this->response = json_encode($response);
    }

    public function returnResponse()
    {
        return $this->response;
    }
}