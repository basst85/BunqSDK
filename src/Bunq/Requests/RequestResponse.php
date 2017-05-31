<?php

namespace Bunq\Requests;


use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class RequestResponse extends BunqObject
{
    /**
     * Request attributes:
     */
    private $amountRespondedValue;
    private $amountRespondedCurrency;
    private $status;
    private $addressShipping;
    private $addressBilling;

    /**
     * Response attributes:
     */
    private $requestResponse;

    /**
     * @return array the request body as an array.
     */
    public function getRequestBodyArray()
    {
        $requestBodyArray = [];

        if(!is_null($this->amountRespondedValue) &&
            !is_null($this->amountRespondedCurrency)) {
            $requestBodyArray['amount_responded'] = ['value' => $this->amountRespondedValue,
                                                    'currency' => $this->amountRespondedCurrency];
        }

        if(!is_null($this->status)) {
            $requestBodyArray['status'] = $this->status;
        }

        if(!is_null($this->addressShipping)) {
            $requestBodyArray['address_shipping'] = $this->addressShipping;
        }

        if(!is_null($this->addressBilling)) {
            $requestBodyArray['address_billing'] = $this->addressBilling;
        }

        return $requestBodyArray;
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        //Since the responses for the different HTTP methods are the same, $method can be ignored.
        $this->requestResponse = json_decode($response->getBodyString())->{'Response'}[0]->{'RequestResponse'};
    }

    /**
     * @return mixed
     */
    public function getAmountRespondedValue()
    {
        return $this->amountRespondedValue;
    }

    /**
     * @param mixed $amountRespondedValue
     */
    public function setAmountRespondedValue($amountRespondedValue)
    {
        $this->amountRespondedValue = $amountRespondedValue;
    }

    /**
     * @return mixed
     */
    public function getAmountRespondedCurrency()
    {
        return $this->amountRespondedCurrency;
    }

    /**
     * @param mixed $amountRespondedCurrency
     */
    public function setAmountRespondedCurrency($amountRespondedCurrency)
    {
        $this->amountRespondedCurrency = $amountRespondedCurrency;
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
    public function getAddressShipping()
    {
        return $this->addressShipping;
    }

    /**
     * @param mixed $addressShipping
     */
    public function setAddressShipping($addressShipping)
    {
        $this->addressShipping = $addressShipping;
    }

    /**
     * @return mixed
     */
    public function getAddressBilling()
    {
        return $this->addressBilling;
    }

    /**
     * @param mixed $addressBilling
     */
    public function setAddressBilling($addressBilling)
    {
        $this->addressBilling = $addressBilling;
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