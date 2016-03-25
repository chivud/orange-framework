<?php


namespace Core\Http;


interface RequestInterface
{
    public function query();

    public function input();

    public function requestMethod();

    public function requestPath();
}