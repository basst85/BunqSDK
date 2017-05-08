<?php


namespace Bunq\MonetaryAccounts;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class MonetaryAccount extends BunqObject
{
    /**
     * Request attributes:
     */
    private $endpoint;

    /**
     * Response attributes:
     */
    private $monetaryAccountBank;

    /**
     * MonetaryAccount constructor.
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
            $this->monetaryAccountBank = json_decode($response->getBodyString())->{'Response'}[0]->{'MonetaryAccountBank'};
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
    public function getMonetaryAccountBank()
    {
        return $this->monetaryAccountBank;
    }

    /**
     * @param mixed $monetaryAccountBank
     */
    public function setMonetaryAccountBank($monetaryAccountBank)
    {
        $this->monetaryAccountBank = $monetaryAccountBank;
    }
}