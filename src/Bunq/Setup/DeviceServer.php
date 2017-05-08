<?php

namespace Bunq\Setup;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;


/**
 * Class DeviceServer
 * Class for the device-server endpoint.
 * @package Bunq\Setup
 */
class DeviceServer extends BunqObject
{
    /**
     * Request attributes:
     */
    private $description;
    private $secret;
    private $permittedIps;

    /**
     * Response attributes:
     */
    private $id;


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
     */
    public function serializeData(BunqResponse $response)
    {
        // TODO: Implement serializeData() method.
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        // TODO: Implement getEndpoint() method.
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        // TODO: Implement setEndpoint() method.
    }
}