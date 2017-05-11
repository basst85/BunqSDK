<?php

namespace Bunq\Setup;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

/**
 * Class Installation
 * Class for the installation endpoint.
 * @package Bunq\ApiCalls
 */
class Installation extends BunqObject
{
    /**
     * Request attributes:
     */
    private $clientPublicKey;

    /**
     * Response attributes:
     */
    private $id;
    private $token;
    private $serverPublicKey;

    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->clientPublicKey)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {
            return ['client_public_key' => $this->clientPublicKey];
        }
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'POST') {
            $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};
            $this->token = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'};
            $this->serverPublicKey = json_decode($response->getBodyString())->{'Response'}[2]->{'ServerPublicKey'};
        }
        elseif($method === 'GET') {
            $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};
        }
    }

    /**
     * @return mixed
     */
    public function getClientPublicKey()
    {
        return $this->clientPublicKey;
    }

    /**
     * @param mixed $clientPublicKey
     */
    public function setClientPublicKey($clientPublicKey)
    {
        $this->clientPublicKey = $clientPublicKey;
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

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getServerPublicKey()
    {
        return $this->serverPublicKey;
    }

    /**
     * @param mixed $serverPublicKey
     */
    public function setServerPublicKey($serverPublicKey)
    {
        $this->serverPublicKey = $serverPublicKey;
    }


}