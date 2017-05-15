<?php

namespace Bunq\Setup;

require '../vendor/autoload.php';

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
    public function getExpiryTime()
    {
        return $this->expiryTime;
    }

    /**
     * @param mixed $expiryTime
     */
    public function setExpiryTime($expiryTime)
    {
        $this->expiryTime = $expiryTime;
    }

    /**
     * @return mixed
     */
    public function getTokenValue()
    {
        return $this->tokenValue;
    }

    /**
     * @param mixed $tokenValue
     */
    public function setTokenValue($tokenValue)
    {
        $this->tokenValue = $tokenValue;
    }

    /**
     * @return mixed
     */
    public function getPermittedDevice()
    {
        return $this->permittedDevice;
    }

    /**
     * @param mixed $permittedDevice
     */
    public function setPermittedDevice($permittedDevice)
    {
        $this->permittedDevice = $permittedDevice;
    }

    
}