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
        $this->httpClient = $httpClient ?: new BunqClient();
    }

    /**
     * Posts a SessionServerRequest to the server.
     * Saves the server response in the sessionServerResponse field.
     *
     * @param $clientPrivateKey String The client private key used for signing the request.
     * @param $installationToken String The installation token from the installation request.
     * @param $serverPublicKey String The server public key used for verification.
     * @param $customRequestHeaders null|array the custom headers for the request.
     * if $customRequestHeaders is null, the default headers will be used.
     *
     * @throws BunqObjectException thrown if the required attributes are missing.
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function post($clientPrivateKey, $installationToken, $serverPublicKey, $customRequestHeaders = null)
    {
        //Create the requestHeaders.
        $requestHeaders = $customRequestHeaders ?: [
            self::HEADER_REQUEST_CACHE_CONTROL => 'no-cache',
            self::HEADER_REQUEST_USER_AGENT => 'SandboxPublicApi:DefaultUser',
            self::HEADER_REQUEST_CUSTOM_AUTHENTICATION => $installationToken,
            self::HEADER_REQUEST_CUSTOM_REQUEST_ID => $this->createUuid(),
            self::HEADER_REQUEST_CUSTOM_GEOLOCATION => '0 0 0 0 000',
            self::HEADER_REQUEST_CUSTOM_LANGUAGE => 'en_US',
            self::HEADER_REQUEST_CUSTOM_REGION => 'en_US',
        ];

        //Create the requestBody.
        if(is_null($this->secret)) {
            throw new BunqObjectException('Missing required attributes.');
        }

        $arrayBody = ['secret' => $this->secret];

        $requestBody = json_encode($arrayBody);

        //Create the requestEndpoint and requestMethod.
        $requestEndpoint = 'session-server';
        $requestMethod = 'POST';

        //Create the request which will be send to the server.
        $sessionServerRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($sessionServerRequest, $clientPrivateKey);

        //Add the request signature to the headers.
        $sessionServerRequest->setHeader(self::HEADER_REQUEST_CUSTOM_SIGNATURE, $signature);

        //Execute the installationRequest and store it in the installationResponse field.
        $this->sessionServerResponse = $this->httpClient->SendRequest($sessionServerRequest);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($this->sessionServerResponse, $serverPublicKey)) {
            throw new BunqVerificationException('Response verification failed.');
        }
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
        return json_decode($this->sessionServerResponse->getBodyString())->{'Response'}[0]->{'Id'};
    }

    /**
     * @return String the response Token.
     */
    public function getToken()
    {
        return json_decode($this->sessionServerResponse->getBodyString())->{'Response'}[1]->{'Token'};
    }

    /**
     * @return String the response UserCompany.
     */
    public function getUserCompany()
    {
        return json_decode($this->sessionServerResponse->getBodyString())->{'Response'}[2]->{'UserCompany'};
    }

    /**
     * @return BunqClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param BunqClient $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return String
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param String $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return BunqResponse
     */
    public function getSessionServerResponse()
    {
        return $this->sessionServerResponse;
    }
}