<?php

namespace Bunq\Idealpayments;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class TokenQrRequestIdeal extends BunqObject
{
    /**
     * Request attributes:
     */
    private $token;

    /**
     * Response attributes:
     */
    private $requestResponse;

    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->token)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {
            return ['token' => $this->token];
        }
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'POST') {
            $this->requestResponse = json_decode($response->getBodyString())->{'Response'}[0]->{'RequestResponse'};
        }
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getRequestResponse()
    {
        return $this->requestResponse;
    }

    /**
     * @param mixed $requestResponse
     */
    public function setRequestResponse($requestResponse)
    {
        $this->requestResponse = $requestResponse;
    }
}