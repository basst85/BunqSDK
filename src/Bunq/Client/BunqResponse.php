<?php

namespace Bunq\Client;

require '../vendor/autoload.php';

/**
 * Class bunqResponse
 * Decoded response from the API.
 * @package Bunq\Client
 */

class BunqResponse
{
    /**
     * A string with the response body.
     *
     * @var string
     */
    private $bodyString;

    /**
     * A string with the response header.
     *
     * @var string
     */
    private $headerString;

    /**
     * A string with the response status code.
     *
     * @var string
     */
    private $statusCode;

    /**
     * The request that returned this response.
     *
     * @var BunqRequest
     */
    private $request;

    /**
     * bunqResponse constructor.
     * @param string $bodyString
     * @param string $headerString
     * @param string $statusCode
     * @param BunqRequest $request
     */
    public function __construct($bodyString, $headerString, $statusCode, $request)
    {
        $this->bodyString = $bodyString;
        $this->headerString = $headerString;
        $this->statusCode = $statusCode;
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getBodyString()
    {
        return $this->bodyString;
    }

    /**
     * @param string $bodyString
     */
    public function setBodyString($bodyString)
    {
        $this->bodyString = $bodyString;
    }

    /**
     * @return string
     */
    public function getHeaderString()
    {
        return $this->headerString;
    }

    /**
     * @param string $headerString
     */
    public function setHeaderString($headerString)
    {
        $this->headerString = $headerString;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param string $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return BunqRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param BunqRequest $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}