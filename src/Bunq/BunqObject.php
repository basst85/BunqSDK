<?php

namespace Bunq;

use Bunq\Client\BunqResponse;

/**
 * Class BunqObject
 * Abstract class for API endpoint objects.
 * @package Bunq
 */
abstract class BunqObject
{
    /**
     * @var String the endpoint for the API call.
     */
    private $endpoint;

    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method) {}

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        Return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }
}