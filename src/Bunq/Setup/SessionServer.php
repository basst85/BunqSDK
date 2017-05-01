<?php

namespace Bunq\Setup;

include_once('Client/BunqClient.php');
include_once('Client/BunqRequest.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\Client\BunqClient;
use Bunq\Client\BunqRequest;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;
use Bunq\Exceptions\BunqVerificationException;

/**
 * Class SessionServer
 * Class for the session-server endpoint.
 * @package Bunq\Setup
 */
class SessionServer
{
    /**
     * Request HTTP header constants.
     */
    const HEADER_REQUEST_CACHE_CONTROL = 'Cache-Control';
    const HEADER_REQUEST_CONTENT_TYPE = 'Content-Type'; // Not to be signed!
    const HEADER_REQUEST_USER_AGENT = 'User-Agent';
    const HEADER_REQUEST_CUSTOM_REQUEST_ID = 'X-Bunq-Client-Request-Id';
    const HEADER_REQUEST_CUSTOM_GEOLOCATION = 'X-Bunq-Geolocation';
    const HEADER_REQUEST_CUSTOM_LANGUAGE = 'X-Bunq-Language';
    const HEADER_REQUEST_CUSTOM_REGION = 'X-Bunq-Region';
    const HEADER_REQUEST_CUSTOM_AUTHENTICATION = 'X-Bunq-Client-Authentication';
    const HEADER_REQUEST_CUSTOM_SIGNATURE = 'X-Bunq-Client-Signature';

    /**
     * @var BunqClient the client which is used to send requests to the server.
     */
    private $httpClient;

    /**
     * @var String the bunq api-key.
     */
    private $secret;

    /**
     * @var BunqResponse the SessionServer response returned by the server.
     */
    private $sessionServerResponse;

    /**
     * SessionServer constructor.
     * @param $secret String the bunq api-key.
     * @param $httpClient null|BunqClient the client used to sens requests.
     */
    public function __construct($secret, $httpClient = null)
    {
        $this->secret = $secret;
        $this->httpClient = httpClient ?: new BunqClient();
    }

    public function post()
    {

    }
}