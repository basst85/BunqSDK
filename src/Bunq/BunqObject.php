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

    /**
     * @return array the request body as an array.
     */
    public abstract function getRequestBodyArray();

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public abstract function serializeData(BunqResponse $response, $method);

    /**
     * @return mixed
     */
    public abstract function getEndpoint();

    /**
     * @param mixed $endpoint
     */
    public abstract function setEndpoint($endpoint);
}