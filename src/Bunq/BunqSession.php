<?php

namespace Bunq;

use Bunq\Setup\Installation;
use Bunq\Setup\DeviceServer;
use Bunq\Setup\SessionServer;
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
    private $clientPrivateKey;

    /**
     * @var array the requestHeaders for this session.
     */
    private $defaultHeaders;

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
     * BunqSession constructor.
     * @param $clientPrivateKey
     * @param $defaultHeaders
     * @param $httpClient
     */
    public function __construct($clientPrivateKey, $defaultHeaders, $httpClient = null)
    {
        $this->clientPrivateKey = $clientPrivateKey;
        $this->defaultHeaders = $defaultHeaders;
        $this->httpClient = $httpClient ?: new BunqClient();
    }

    /**
     * Creates an installation on the server.
     * Stores the installation data in the given object.
     * Extracts the needed data for the session.
     * @param Installation $object
     */
    public function createInstallation(Installation $object)
    {
        //Create the data needed for the BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'POST';
        $requestHeaders = $this->getRequestHeaders();
        $requestBody = json_encode($object->getRequestBodyArray());

        //Create and execute the installation request.
        $installationRequest = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        $installationResponse = $this->httpClient->SendRequest($installationRequest);

        //Extract and store the returned data.
        $object->serializeData($installationResponse, 'POST');
        $object->setResponse($installationResponse);

        //Store the installation for future use.
        $this->installation = $object;
    }

    /**
     * Creates a deviceServer.
     *
     * @param BunqObject|DeviceServer $object the deviceServerObject.
     */
    public function createDeviceServer(DeviceServer $object)
    {
        //Use the post method to create a deviceServer.
        $this->post($object);

        //Store the device server for future use.
        $this->deviceServer = $object;
    }

    /**
     * Creates a sessionServer.
     *
     * @param BunqObject|SessionServer $object the sessionServer object.
     */
    public function createSessionServer(SessionServer $object)
    {
        //Use the post method to create a sessionServer.
        $this->post($object);

        //Store the device server for future use.
        $this->sessionServer = $object;
    }

    /**
     * Sends a POST request to the server using the given BunqObject.
     *
     * @param BunqObject $object
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function post(BunqObject $object)
    {
        //Create the data for the needed BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'POST';
        $requestHeaders = $this->getRequestHeaders();
        $requestBody = json_encode($object->getRequestBodyArray());

        //Create the POST request.
        $request = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($request, $this->clientPrivateKey);

        //Add the request signature to the headers.
        $request->setHeader('X-Bunq-Client-Signature', $signature);

        //Send the deviceServerRequest.
        $response = $this->httpClient->SendRequest($request);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($response, $this->installation->getServerPublicKey()->{'server_public_key'})) {
            throw new BunqVerificationException('Response verification failed.');
        }

        //Extract and store the returned data.
        $object->serializeData($response, 'POST');
        $object->setResponse($response);
    }

    /**
     * Sends a GET request to the server using the given BunqObject.
     *
     * @param BunqObject $object
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function get(BunqObject $object)
    {
        //Create the data for the needed BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'GET';
        $requestHeaders = $this->getRequestHeaders();

        //Create a new GET request.
        $request = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($request, $this->clientPrivateKey);

        //Add the request signature to the headers.
        $request->setHeader('X-Bunq-Client-Signature', $signature);

        //Send the GET request.
        $response = $this->httpClient->SendRequest($request);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($response, $this->installation->getServerPublicKey()->{'server_public_key'})) {
            throw new BunqVerificationException('Response verification failed.');
        }

        //Extract and store the returned data.
        $object->serializeData($response, 'GET');
        $object->setResponse($response);
    }

    /**
     * Sends a DELETE request to the server using the given BunqObject.
     *
     * @param BunqObject $object
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function delete(BunqObject $object)
    {
        //Create the data for the needed BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'DELETE';
        $requestHeaders = $this->getRequestHeaders();

        //Create the DELETE request.
        $request = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($request, $this->clientPrivateKey);

        //Add the request signature to the headers.
        $request->setHeader('X-Bunq-Client-Signature', $signature);

        //Send the deviceServerRequest.
        $response = $this->httpClient->SendRequest($request);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($response, $this->installation->getServerPublicKey()->{'server_public_key'})) {
            throw new BunqVerificationException('Response verification failed.');
        }
    }

    /**
     * Sends a PUT request to the server using the given BunqObject.
     *
     * @param BunqObject $object
     * @throws BunqVerificationException thrown if the response verification fails.
     */
    public function put(BunqObject $object)
    {
        //Create the data for the needed BunqRequest.
        $requestEndpoint = $object->getEndpoint();
        $requestMethod = 'PUT';
        $requestHeaders = $this->getRequestHeaders();
        $requestBody = json_encode($object->getRequestBodyArray());

        //Create the PUT request.
        $request = new BunqRequest($requestEndpoint, $requestMethod, $requestHeaders, $requestBody);

        //Sign the request with the installation private key.
        $signature = $this->httpClient->getRequestSignature($request, $this->clientPrivateKey);

        //Add the request signature to the headers.
        $request->setHeader('X-Bunq-Client-Signature', $signature);

        //Send the deviceServerRequest.
        $response = $this->httpClient->SendRequest($request);

        //Verify the response.
        if(!$this->httpClient->verifyResponseSignature($response, $this->installation->getServerPublicKey()->{'server_public_key'})) {
            throw new BunqVerificationException('Response verification failed.');
        }

        //Extract and store the returned data.
        $object->serializeData($response, 'PUT');
        $object->setResponse($response);
    }

    public function getRequestHeaders()
    {
        //If there is no installation, the installationHeaders are needed.
        //That means no tokens.
        if(is_null($this->installation)) {
            $requestHeaders = $this->defaultHeaders;
            $requestHeaders['X-Bunq-Client-Request-Id'] = $this->createUuid();
        }
        //If there is no deviceServer, or sessionServer the deviceServerHeaders are needed.
        //That means the installationToken is needed.
        elseif(is_null($this->deviceServer) || is_null($this->sessionServer)) {
            $requestHeaders = $this->defaultHeaders;
            $requestHeaders['X-Bunq-Client-Request-Id'] = $this->createUuid();
            $requestHeaders['X-Bunq-Client-Authentication'] = $this->installation->getToken()->{'token'};

        }
        //Else: Normal request headers are needed.
        //That means the sessionToken is needed.
        else {
            $requestHeaders = $this->defaultHeaders;
            $requestHeaders['X-Bunq-Client-Request-Id'] = $this->createUuid();
            $requestHeaders['X-Bunq-Client-Authentication'] = $this->sessionServer->getToken()->{'token'};
        }

        return $requestHeaders;
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
     * @return mixed
     */
    public function getClientPrivateKey()
    {
        return $this->clientPrivateKey;
    }

    /**
     * @param mixed $clientPrivateKey
     */
    public function setClientPrivateKey($clientPrivateKey)
    {
        $this->clientPrivateKey = $clientPrivateKey;
    }

    /**
     * @return array
     */
    public function getDefaultHeaders()
    {
        return $this->defaultHeaders;
    }

    /**
     * @param array $defaultHeaders
     */
    public function setDefaultHeaders($defaultHeaders)
    {
        $this->defaultHeaders = $defaultHeaders;
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
     * @return Installation
     */
    public function getInstallation()
    {
        return $this->installation;
    }

    /**
     * @param Installation $installation
     */
    public function setInstallation($installation)
    {
        $this->installation = $installation;
    }

    /**
     * @return DeviceServer
     */
    public function getDeviceServer()
    {
        return $this->deviceServer;
    }

    /**
     * @param DeviceServer $deviceServer
     */
    public function setDeviceServer($deviceServer)
    {
        $this->deviceServer = $deviceServer;
    }

    /**
     * @return SessionServer
     */
    public function getSessionServer()
    {
        return $this->sessionServer;
    }

    /**
     * @param SessionServer $sessionServer
     */
    public function setSessionServer($sessionServer)
    {
        $this->sessionServer = $sessionServer;
    }

}