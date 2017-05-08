<?php

namespace Bunq\Setup;

include_once('BunqObject.php');

use Bunq\BunqObject;

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


}