<?php

namespace Bunq\Client;

require '../vendor/autoload.php';

use Bunq\Exceptions\BunqSDKException;

/**
 * Class BunqRequest
 * Request to send to the API.
 * @package Bunq\Client
 */

class BunqRequest
{
    /**
     * The endpoint is the part of the URL after the apiVersion (e.g. the part after 'v1/')
     * Example: user/1/monetary-account/11/payment
     *
     * @var string
     */
    private $endpoint;

    /**
     * The call method. Can be POST, GET, PUT or DELETE.
     *
     * @var string
     */
    private $method;

    /**
     * The body of this request represented as a string.
     *
     * @var string
     */
    private $body;

    /**
     * An array containing al the headers for this request.
     *
     * @var string[]
     */
    private $headers = [];

    /**
     * A string with the response body.
     *
     * @var string
     */

    /**
     * BunqRequest constructor.
     * @param $endpoint
     * @param $method
     * @param $body
     * @param $headers
     */
    public function __construct($endpoint, $method, $headers ,$body = null)
    {
        $this->setEndpoint($endpoint);
        $this->setMethod($method);
        $this->setHeaders($headers);
        $this->setBody($body);

    }

    public function validateMethod()
    {
        if(!$this->method){
            throw new BunqSDKException('HTTP method not specified.');
        }

        if(!in_array($this->method, ['GET', 'POST', 'PUT', 'DELETE'])) {
            throw new BunqSDKException('invalid HTTP method specified');
        }
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return \string[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param \string[] $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set a specific header for this request.
     * Example: $request->setHeader(Request::HEADER_REQUEST_CACHE_CONTROL, 'no-cache');
     *
     * @param string $key
     * @param string $value
     */
    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }
}