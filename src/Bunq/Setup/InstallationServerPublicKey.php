<?php

namespace Bunq\Setup;

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class InstallationServerPublicKey extends BunqObject
{
    /**
     * Response attributes:
     */
    private $serverPublicKey;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'GET') {
            $this->serverPublicKey = json_decode($response->getBodyString())->{'Response'}[0]->{'ServerPublicKey'};
        }
    }

    /**
     * @return mixed
     */
    public function getServerPublicKey()
    {
        return $this->serverPublicKey;
    }

    /**
     * @param mixed $serverPublicKey
     */
    public function setServerPublicKey($serverPublicKey)
    {
        $this->serverPublicKey = $serverPublicKey;
    }


}