<?php

namespace Core\Http;


abstract class AbstractResponse implements ResponseInterface
{
    protected $response;
    protected $statusCode;
    protected $statusText;
    protected $headers;

    public function __construct($response = null, $statusCode = 200, $statusText = 'OK')
    {
        $this->response = $response;
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }


    public function send()
    {

        $this->preSendOperations();
        $this->setHeaders();
        $this->sendContent();

        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        return $this;
    }

    protected function preSendOperations(){
        return null;
    }

    private function setHeaders()
    {
        if (headers_sent()) {
            return $this;
        }

        header(sprintf('HTTP/1.1 %s %s', $this->statusCode, $this->statusText));

        if (is_array($this->headers) && !empty($this->headers)) {

            foreach ($this->headers as $header) {
                header($header);
            }
        }

        return $this;

    }

    private function sendContent()
    {
        echo $this->getResponse();

        return $this;
    }
}