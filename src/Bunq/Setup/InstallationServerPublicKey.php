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

class InstallationServerPublicKey
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
     * @var BunqResponse the installationServerPublicKeyResponse returned by the server.
     */
    private $installationServerPublicKeyResponse;

    /**
     * InstallationServerPublicKey constructor.
     * @param $secret String the bunq api-key.
     * @param $httpClient null|BunqClient the client used to sens requests.
     */
    public function __construct($httpClient = null)
    {
        $this->httpClient = $httpClient ?: new BunqClient();
    }

    /**
     * Sends a get installationServerPublicKey request to the server using the installationId.
     * Saves the response in the installationServerPublicKeyResponse field.
     *
     * If the installationId is null, the server will return a response containing a list of the device servers.
     *
     * @param $installationId integer the id of the installation to get.
     * @param $sessionToken String the session token for authorisation.
     * @param $clientPrivateKey String the client private key for signing the request.
     * @param $customRequestHeaders null|array the custom headers for the request.
     * if $customRequestHeaders is null, the default headers will be used.
     *
     * @throws BunqObjectException thrown if the required attributes are missing.
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function get($installationId, $sessionToken, $clientPrivateKey, $customRequestHeaders = null)
    {
        //Check the installationId.
        if(is_null($installationId)) {
            throw new BunqObjectException('Missing required attributes.');
        }

        //Create the requestHeaders.
        $requestHeaders = $customRequestHeaders ?: [
            self::HEADER_REQUEST_CACHE_CONTROL => 'no-cache',
            self::HEADER_REQUEST_USER_AGENT => 'SandboxPublicApi:DefaultUser',
            self::HEADER_REQUEST_CUSTOM_AUTHENTICATION => $sessionToken,
            self::HEADER_REQUEST_CUSTOM_REQUEST_ID => $this->createUuid(),
            self::HEADER_REQUEST_CUSTOM_GEOLOCATION => '0 0 0 0 000',
            self::HEADER_REQUEST_CUSTOM_LANGUAGE => 'en_US',
            self::HEADER_REQUEST_CUSTOM_REGION => 'en_US',
        ];

        //Create the requestEndpoint and requestMethod.
        $requestEndpoint = 'installation/' . $installationId . "/server-public-key";
        $requestMethod = 'GET';

        //Create the request which will be send to the server.
        $installationServerPublicKeyRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($installationServerPublicKeyRequest, $clientPrivateKey);

        //Add the request signature to the headers.
        $installationServerPublicKeyRequest->setHeader(self::HEADER_REQUEST_CUSTOM_SIGNATURE, $signature);

        //Send the installationRequest and store it in the installationResponse field.
        $this->installationServerPublicKeyResponse = $this->httpClient->SendRequest($installationServerPublicKeyRequest);
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
     * @return String the server public key.
     */
    public function getServerPublicKey()
    {
        return json_decode($this->installationServerPublicKeyResponse->getBodyString())->{'Response'}[0]->{'ServerPublicKey'};
    }
}