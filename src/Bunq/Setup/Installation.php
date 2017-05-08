<?php

namespace Bunq\Setup;

include_once('BunqObject.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

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

    private $tokenId;
    private $tokenCreated;
    private $tokenUpdated;
    private $token;

    private $serverPublicKey;

    public function getRequestBodyArray()
    {
        return ['client_public_key' => $this->clientPublicKey];
    }

    public function serializeData(BunqResponse $response)
    {
        $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};

        $this->tokenId = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'id'};
        $this->tokenCreated = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'created'};
        $this->tokenUpdated = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'updated'};
        $this->token = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'}->{'token'};

        $this->serverPublicKey = json_decode($response->getBodyString())->{'Response'}[2]->{'ServerPublicKey'}->{'server_public_key'};
    }
}