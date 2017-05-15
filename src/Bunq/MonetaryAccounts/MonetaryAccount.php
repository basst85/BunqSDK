<?php


namespace Bunq\MonetaryAccounts;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class MonetaryAccount extends BunqObject
{
    /**
     * Request attributes:
     */

    /**
     * Response attributes:
     */
    private $monetaryAccountBank;

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