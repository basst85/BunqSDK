<?php

namespace Bunq\Client\Http;

require '../vendor/autoload.php';

/**
 * Class BunqRawResponse
 * The raw response used by the BunqCurlHttpClient.
 * @package Bunq\Client\Http
 */

class BunqRawResponse
{
    /**
     * A string with the response headers.
     *
     * @var String
     */
    private $headers;

    /**
     * A string with the response body.
     *
     * @var String
     */
    private $body;

    /**
     * A string with the response status code.
     *
     * @var String
     */
    private $httpStatusCode;

    /**
     * BunqRawResponse constructor.
     * @param $headers
     * @param $body
     * @param $httpStatusCode
     */
    public function __construct($headers, $body, $httpStatusCode)
    {
        $this->headers = $headers;
        $this->body = $body;
        $this->httpStatusCode = $httpStatusCode;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @param mixed $httpStatusCode
     */
    public function setHttpStatusCode($httpStatusCode)
    {
        $this->httpStatusCode = $httpStatusCode;
    }




}