<?php

namespace Core\Http;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * Response data.
     * @var mixed
     */
    protected $response;

    /**
     * HTTP status code
     * @var int
     */
    protected $statusCode;

    /**
     * HTTP status string
     * @var string
     */
    protected $statusText;

    /**
     * Headers
     * @var array
     */
    protected $headers;

    /**
     * Construct the response with all necessary data
     * @param mixed $response
     * @param int $statusCode
     * @param string $statusText
     */
    public function __construct($response = null, $statusCode = 200, $statusText = 'OK')
    {
        $this->response = $response;
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }

    /**
     * Send the response to the client
     * @return $this
     */
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

    /**
     * This is the container for all operations that are done before
     * sending data to the client.
     * @return mixed
     */
    protected function preSendOperations()
    {
        return null;
    }

    /**
     * Send headers to the client
     * @return $this
     */
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

    /**
     * Echo the response to the client
     * @return $this
     */
    private function sendContent()
    {
        echo $this->getResponse();

        return $this;
    }
}
