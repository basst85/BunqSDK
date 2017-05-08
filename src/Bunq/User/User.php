<?php

namespace Bunq\User;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class User extends BunqObject
{

    /**
     * Request attributes:
     */
    private $endpoint;

    /**
     * Response attributes:
     */
    private $userCompany;

    /**
     * User constructor.
     * @param $endpoint
     */
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return array the request body as an array.
     */
    public function getRequestBodyArray()
    {
        //There is no request body since this object is only used for getting data.
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'GET') {
            $this->userCompany = json_decode($response->getBodyString())->{'Response'}[0]->{'UserCompany'};
        }
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getUserCompany()
    {
        return $this->userCompany;
    }

    /**
     * @param mixed $userCompany
     */
    public function setUserCompany($userCompany)
    {
        $this->userCompany = $userCompany;
    }
}