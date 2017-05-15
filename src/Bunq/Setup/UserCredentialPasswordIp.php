<?php

namespace Bunq\Setup;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class UserCredentialPasswordIp extends BunqObject
{
    /**
     * Response attributes:
     */
    private $status;
    private $expiryTime;
    private $tokenValue;
    private $permittedDevice;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'GET') {
            $this->status = json_decode($response->getBodyString())->{'Response'}[0]->{'status'};
            $this->expiryTime = json_decode($response->getBodyString())->{'Response'}[0]->{'expiry_time'};
            $this->tokenValue = json_decode($response->getBodyString())->{'Response'}[0]->{'token_value'};
            $this->permittedDevice = json_decode($response->getBodyString())->{'Response'}[0]->{'Permitted_device'};
        }
    }
}