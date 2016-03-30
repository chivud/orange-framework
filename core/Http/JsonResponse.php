<?php

namespace Core\Http;

class JsonResponse extends AbstractResponse
{

    public function getResponse()
    {

        return json_encode($this->response);
    }

    protected function preSendOperations()
    {
        $this->headers[] = 'Content-Type: application/json';
    }
}
