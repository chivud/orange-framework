<?php

namespace Core\Http;


interface ResponseInterface
{
    public function __construct($response);

    public function returnResponse();
}