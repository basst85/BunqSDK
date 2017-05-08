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
    private $endpoint = 'device-server';
    private $description;
    private $secret;
    private $permittedIps;

    /**
     * Response attributes:
     */
    private $id;

    public function __construct($description, $secret, $permittedIps, $endpoint)
    {
        $this->description = $description;
        $this->secret = $secret;
        $this->permittedIps = $permittedIps;
        $this->endpoint = $endpoint;
    }

    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->description) ||
            is_null($this->secret)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {
            $bodyArray = [
                'description' => $this->description,
                'secret' => $this->secret];
            if(!is_null($this->permittedIps)) {
                $bodyArray['permitted_ips'] = $this->permittedIps;
            }
        }

        return $bodyArray;
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     */
    public function serializeData(BunqResponse $response)
    {
        $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'}->{'id'};
    }

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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getPermittedIps()
    {
        return $this->permittedIps;
    }

    /**
     * @param mixed $permittedIps
     */
    public function setPermittedIps($permittedIps)
    {
        $this->permittedIps = $permittedIps;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}