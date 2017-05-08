<?php

namespace Bunq\User;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class User extends BunqObject
{

    /**
     * Request attributes:
     */
    private $endpoint;

    /**
     * Response attributes:
     */

    /**
     * @return array the request body as an array.
     */
    public function getRequestBodyArray()
    {
        // TODO: Implement getRequestBodyArray() method.
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        // TODO: Implement serializeData() method.
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }
}