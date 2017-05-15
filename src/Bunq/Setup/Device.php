<?php

namespace Bunq\Setup;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class Device extends BunqObject
{
    /**
     * Response attributes:
     */
    private $device;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {

        if($method === 'GET') {
            $decoded = json_decode($response->getBodyString())->{'Response'}[0];
            if(property_exists($decoded, 'DevicePhone')) {
                $this->device = $decoded->{'DevicePhone'};
            }

            elseif(property_exists($decoded, 'DeviceServer')){
                $this->device = $decoded->{'DeviceServer'};
            }

        }
    }

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }


}