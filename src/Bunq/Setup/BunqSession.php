<?php

namespace Bunq\Setup;


include_once('BunqObject.php');
include_once('Client/BunqClient.php');
include_once('Client/BunqRequest.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');
include_once('Exceptions/BunqVerificationException.php');
include_once('Setup/Installation.php');
include_once('Setup/DeviceServer.php');

use Bunq\BunqObject;
use Bunq\Client\BunqClient;
use Bunq\Client\BunqRequest;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;
use Bunq\Exceptions\BunqVerificationException;


/**
 * Class BunqSession
 * Class for the session-server endpoint.
 * Used to create installations, device servers and sessions.
 * The session created here will be used in future API-calls.
 * @package Bunq\Setup
 */
class BunqSession
{
    /**
     * The keys for signing requests.
     */
    private $clientPublicKey;
    private $clientPrivateKey;
    private $serverPublicKey;

    /**
     * The data for this session.
     */
    private $sessionId;
    private $sessionToken;

    /**
     * @var array the requestHeaders for this session.
     */
    private $headers;

    /**
     * @var BunqClient the client used to send request to the server.
     */
    private $httpClient;

    /**
     * @var Installation the current installation.
     * Contains the serverPublicKey
     */
    private $installation;

    /**
     * @var DeviceServer the current deviceServer.
     */
    private $deviceServer;

    /**
     * @var SessionServer the current sessionServer.
     */
    private $sessionServer;

    /**
     * Creates an installation on the server.
     * Stores the installation data in the given object.
     * Extracts the needed data for the session.
     */
    public function createInstallation()
    {
        //Create the installationObject.
        $installation = new Installation('installation', $this->clientPublicKey);

        //Create the data needed for the BunqRequest.
        $requestEndpoint = $installation->getEndpoint();
        $requestMethod = 'POST';
        $requestHeaders = $this->headers;
        $requestBody = json_encode($installation->getRequestBodyArray());

        //Create and execute the installation request.
        $installationRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        $installationResponse = $this->httpClient->SendRequest($installationRequest);

        //Extract and store the returned data.
        $installation->serializeData($installationResponse);

        //Store the installation for future use.
        $this->installation = $installation;
        $this->serverPublicKey = $installation->getServerPublicKey();

    }

    /**
     * Creates a deviceServer.
     *
     * @param BunqObject $object the deviceServerObject.
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function createDeviceServer(BunqObject $object)
    {
        //Create the data needed for the BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'POST';
        $requestHeaders = $this->headers;
        $requestBody = json_encode($object->getRequestBodyArray());

        //Create the deviceServer request.
        $deviceServerRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($deviceServerRequest, $this->clientPrivateKey);

        //Add the request signature to the headers.
        $deviceServerRequest->setHeader('X-Bunq-Client-Signature', $signature);

        //Send the deviceServerRequest.
        $deviceServerResponse = $this->httpClient->SendRequest($deviceServerRequest);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($deviceServerResponse, $this->serverPublicKey)) {
            throw new BunqVerificationException('Response verification failed.');
        }

        //Extract and store the returned data.
        $object->serializeData($deviceServerResponse);

        //Store the device server for future use.
        $this->deviceServer = $object;
    }

    /**
     * Creates a sessionServer.
     *
     * @throws BunqObjectException thrown if the required attributes are missing.
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function createSessionServer(BunqObject $object)
    {
        //Create the data needed for the BungRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'POST';
        $requestHeaders = $this->headers;
        $requestBody = json_encode($object->getRequestBodyArray());

        //Create the sessionServerRequest.
        $sessionServerRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($sessionServerRequest, $this->clientPrivateKey);

        //Add the request signature to the headers.
        $sessionServerRequest->setHeader('X-Bunq-Client-Signature', $signature);

        //Send the deviceServerRequest.
        $sessionServerResponse = $this->httpClient->SendRequest($sessionServerRequest);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($sessionServerResponse, $this->serverPublicKey)) {
            throw new BunqVerificationException('Response verification failed.');
        }

        //Extract and store the returned data.
        $object->serializeData($sessionServerResponse);

        //Store the device server for future use.
        $this->sessionServer = $object;
    }

    public function post(BunqObject $object)
    {

    }

    public function get(BunqObject $object)
    {

    }

    public function delete(BunqObject $object)
    {

    }

    public function put(BunqObject $object)
    {

    }
}