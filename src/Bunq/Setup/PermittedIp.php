<?php

namespace Bunq\Setup;

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class PermittedIp extends BunqObject
{
    /**
     * Request attributes:
     */
    private $ip;
    private $status;

    /**
     * Response attributes:
     */
    private $response;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        //Since the responses for the POST, PUT and GET methods are the same, $method can be ignored.
        $this->response = json_decode($response->getBodyString())->{'Response'}[0];
    }

    /**
     * @return array the request body as an array.
     */
    public function getRequestBodyArray()
    {
        $requestBody = [];

        if(!is_null($this->ip)) {
            $requestBody['ip'] = $this->ip;
        }

        if(!is_null($this->status)) {
            $requestBody['status'] = $this->status;
        }

        return $requestBody;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }


}