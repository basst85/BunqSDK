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

/**
 * Class Installation
 * Class for the installation endpoint.
 * @package Bunq\ApiCalls
 */
class Installation
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

    /**
     * @var BunqClient the client which is used to send requests to the server.
     */
    private $httpClient;

    /**
     * @var String the client public key.
     */
    private $clientPublicKey;

    /**
     * @var BunqResponse the installation response returned by the server.
     */
    private $installationResponse;


    /**
     * Installation constructor.
     * @param $clientPublicKey
     * @param null $httpClient
     */
    public function __construct($clientPublicKey, $httpClient = null)
    {
        $this->clientPublicKey = $clientPublicKey;
        $this->httpClient = $httpClient ?: new BunqClient();
    }

    /**
     * Posts an installationRequest to the server using the clientPublicKey.
     * Saves the server response in the installationResponse field.
     *
     * @param $customRequestHeaders null|array the custom headers for the request.
     * if $customRequestHeaders is null, the default headers will be used.
     *
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function post($customRequestHeaders = null)
    {
        //Create the requestHeaders.
        $requestHeaders = $customRequestHeaders ?: [
            self::HEADER_REQUEST_CACHE_CONTROL => 'no-cache',
            self::HEADER_REQUEST_USER_AGENT => 'SandboxPublicApi:DefaultUser',
            self::HEADER_REQUEST_CUSTOM_REQUEST_ID => $this->createUuid(),
            self::HEADER_REQUEST_CUSTOM_GEOLOCATION => '0 0 0 0 000',
            self::HEADER_REQUEST_CUSTOM_LANGUAGE => 'en_US',
            self::HEADER_REQUEST_CUSTOM_REGION => 'en_US',
        ];

        if(is_null($this->clientPublicKey)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        //Create the requestBody.
        $arrayBody = ['client_public_key' => $this->clientPublicKey];
        $requestBody = json_encode($arrayBody);

        //Create the requestEndpoint and requestMethod.
        $requestEndpoint = 'installation';
        $requestMethod = 'POST';

        //Create the request which will be send to the server.
        $installationRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        //Execute the installationRequest and store it in the installationResponse field.
        $this->installationResponse = $this->httpClient->SendRequest($installationRequest);
    }

    public function get()
    {

    }

    /**
     * Create a new unique identifier.
     *
     * @return string The unique identifier.
     */
    private function createUuid()
    {
        $randomInput = openssl_random_pseudo_bytes(16);
        $randomInput[6] = chr(ord($randomInput[6]) & 0x0f | 0x40);
        $randomInput[8] = chr(ord($randomInput[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($randomInput), 4));
    }

    /**
     * @return String the response ID.
     */
    public function getId()
    {
        return json_decode($this->installationResponse->getBodyString())->{'Response'}[0]->{'Id'};
    }

    /**
     * @return String the response token.
     */
    public function getToken()
    {
        return json_decode($this->installationResponse->getBodyString())->{'Response'}[1]->{'Token'};
    }

    /**
     * @return String the server public key.
     */
    public function getServerPublicKey()
    {
        return json_decode($this->installationResponse->getBodyString())->{'Response'}[2]->{'ServerPublicKey'};
    }

    /**
     * @return BunqClient the client which used to send requests.
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param BunqClient $httpClient set the client which is used to send requests.
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return String the client public key which will be send to the server.
     */
    public function getClientPublicKey()
    {
        return $this->clientPublicKey;
    }

    /**
     * @param String $clientPublicKey set the client public key which will be send to the server.
     */
    public function setClientPublicKey($clientPublicKey)
    {
        $this->clientPublicKey = $clientPublicKey;
    }

    /**
     * @return BunqResponse
     */
    public function getInstallationResponse()
    {
        return $this->installationResponse;
    }
}