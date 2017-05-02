<?php

namespace Bunq\Setup;

include_once('Client/BunqClient.php');
include_once('Client/BunqRequest.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');
include_once('Exceptions/BunqVerificationException.php');

use Bunq\Client\BunqClient;
use Bunq\Client\BunqRequest;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;
use Bunq\Exceptions\BunqVerificationException;


class PermittedIp
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
     * @var String the ip address to send to the server.
     */
    private $ip;

    /**
     * @var String the status for the ip address
     */
    private $status;

    /**
     * @var BunqResponse the SessionServer response returned by the server.
     */
    private $PermittedIpResponse;

    /**
     * PermittedIp constructor.
     * @param $ip String the ip address.
     * @param $status null|String the status for the ip address.
     * @param $httpClient null|BunqClient the client used to sens requests.
     */
    public function __construct($ip, $status = null, $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new BunqClient();
        $this->ip = $ip;
        $this->status = $status;
    }

    public function post()
    {

    }

    public function put()
    {

    }

    public function get()
    {

    }
}