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
    private $endpoint = "installation";
    private $clientPublicKey;

    /**
     * Response attributes:
     */
    private $id;

    private $tokenId;
    private $tokenCreated;
    private $tokenUpdated;
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
     */
    public function serializeData(BunqResponse $response)
    {
        $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};

        $this->tokenId = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'id'};
        $this->tokenCreated = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'created'};
        $this->tokenUpdated = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'updated'};
        $this->token = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'token'};

        $this->serverPublicKey = json_decode($response->getBodyString())->{'Response'}[2]->{'ServerPublicKey'}->{'server_public_key'};
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
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * @param mixed $tokenId
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;
    }

    /**
     * @return mixed
     */
    public function getTokenCreated()
    {
        return $this->tokenCreated;
    }

    /**
     * @param mixed $tokenCreated
     */
    public function setTokenCreated($tokenCreated)
    {
        $this->tokenCreated = $tokenCreated;
    }

    /**
     * @return mixed
     */
    public function getTokenUpdated()
    {
        return $this->tokenUpdated;
    }

    /**
     * @param mixed $tokenUpdated
     */
    public function setTokenUpdated($tokenUpdated)
    {
        $this->tokenUpdated = $tokenUpdated;
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