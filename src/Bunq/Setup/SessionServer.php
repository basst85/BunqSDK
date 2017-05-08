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
 * Class SessionServer
 * Class for the session-server endpoint.
 * Used to create installations, device servers and sessions.
 * The session created here will be used in future API-calls.
 * @package Bunq\Setup
 */
class SessionServer
{
    /**
     * The client keys for signing requests.
     */
    private $clientPublicKey;
    private $clientPrivateKey;

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

    }

    public function createDeviceServer(BunqObject $object)
    {
        //Create the data needed for the BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'POST';
        $requestHeaders = $this->headers;
        $requestBody = json_encode($object->getRequestBodyArray());

        //Create and execute the deviceServer request.
        $deviceServerRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        $deviceServerResponse = $this->httpClient->SendRequest($deviceServerRequest);

        //Extract and store the returned data.
        $object->serializeData($deviceServerResponse);

        //Store the device server for future use.
        $this->deviceServer = $object;

        //TODO: Signing and verifing.
    }

    public function createSession()
    {

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