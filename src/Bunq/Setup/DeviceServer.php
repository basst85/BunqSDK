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
 * Class DeviceServer
 * Class for the device-server endpoint.
 * @package Bunq\Setup
 */
class DeviceServer
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
     * @var String the DeviceServer description.
     */
    private $description;

    /**
     * @var String the bunq api-key.
     */
    private $secret;

    /**
     * @var array The permitted ips this DeviceServer will be able to do calls from.
     */
    private $permittedIps;

    /**
     * @var BunqResponse the DeviceServer response returned by the server.
     */
    private $deviceServerResponse;

    public function __construct($description, $secret, $permittedIps = null, $httpClient = null)
    {
        $this->description = $description;
        $this->secret = $secret;
        $this->permittedIps = $permittedIps;
        $this->httpClient = $httpClient ?: new BunqClient();
    }

    /**
     * Posts a DeviceServerRequest to the server.
     * Saves the server response in the deviceServerResponse field.
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
        if(is_null($this->description) || is_null($this->secret)) {
            throw new BunqObjectException('Missing required attributes.');
        }

        $arrayBody = [
            'description' => $this->description,
            'secret' => $this->secret];

        if(!is_null($this->permittedIps)) {
            $arrayBody['permitted_ips'] = $this->permittedIps;
        }

        $requestBody = json_encode($arrayBody);

        //Create the requestEndpoint and requestMethod.
        $requestEndpoint = 'device-server';
        $requestMethod = 'POST';

        //Create the request which will be send to the server.
        $deviceServerRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestBody, $requestHeaders);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($deviceServerRequest, $clientPrivateKey);

        //Add the request signature to the headers.
        $deviceServerRequest->setHeader(self::HEADER_REQUEST_CUSTOM_SIGNATURE, $signature);

        //Execute the installationRequest and store it in the installationResponse field.
        $this->deviceServerResponse = $this->httpClient->SendRequest($deviceServerRequest);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($this->deviceServerResponse, $serverPublicKey)) {
            throw new BunqVerificationException('Response verification failed.');
        }
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
        return json_decode($this->deviceServerResponse->getBodyString())->{'Response'}[0]->{'Id'};
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return array
     */
    public function getPermittedIps()
    {
        return $this->permittedIps;
    }

    /**
     * @param array $permittedIps
     */
    public function setPermittedIps($permittedIps)
    {
        $this->permittedIps = $permittedIps;
    }

    /**
     * @return BunqResponse
     */
    public function getDeviceServerResponse()
    {
        return $this->deviceServerResponse;
    }
}