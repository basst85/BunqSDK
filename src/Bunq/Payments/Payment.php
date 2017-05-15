<?php

namespace Bunq\Payments;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class Payment extends BunqObject
{
    /**
     * Request attributes:
     */
    private $amountValue;
    private $amountCurrency;
    private $counterPartyAliasType;
    private $counterPartyAliasValue;
    private $description;
    private $attachmentId;
    private $merchantReference;

    /**
     * Response attributes:
     */
    private $id;
    private $payment;

    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->amountValue) ||
            is_null($this->amountCurrency) ||
            is_null($this->counterPartyAliasType) ||
            is_null($this->description)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {

            $requestBodyArray = [
                'amount' => [
                    'value' => $this->amountValue,
                    'currency' => $this->amountCurrency
                ],
                'counterparty_alias' => [
                    'type' => $this->counterPartyAliasType,
                    'value' => $this->counterPartyAliasValue
                ],
                'description' => $this->description
            ];

            if(!is_null($this->attachmentId)) {
                $requestBodyArray['attachment'] = ['id' => $this->attachmentId];
            }

            if(!is_null($this->merchantReference)) {
                $requestBodyArray['merchant_reference'] = $this->merchantReference;
            }
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
        if($method === 'POST') {
            $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};
        }
        if($method === 'GET') {
            $this->payment = json_decode($response->getBodyString())->{'Response'}[0]->{'Payment'};
        }
    }

    /**
     * @return mixed
     */
    public function getAmountValue()
    {
        return $this->amountValue;
    }

    /**
     * @param mixed $amountValue
     */
    public function setAmountValue($amountValue)
    {
        $this->amountValue = $amountValue;
    }

    /**
     * @return mixed
     */
    public function getAmountCurrency()
    {
        return $this->amountCurrency;
    }

    /**
     * @param mixed $amountCurrency
     */
    public function setAmountCurrency($amountCurrency)
    {
        $this->amountCurrency = $amountCurrency;
    }

    /**
     * @return mixed
     */
    public function getCounterPartyAliasType()
    {
        return $this->counterPartyAliasType;
    }

    /**
     * @param mixed $counterPartyAliasType
     */
    public function setCounterPartyAliasType($counterPartyAliasType)
    {
        $this->counterPartyAliasType = $counterPartyAliasType;
    }

    /**
     * @return mixed
     */
    public function getCounterPartyAliasValue()
    {
        return $this->counterPartyAliasValue;
    }

    /**
     * @param mixed $counterPartyAliasValue
     */
    public function setCounterPartyAliasValue($counterPartyAliasValue)
    {
        $this->counterPartyAliasValue = $counterPartyAliasValue;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAttachmentId()
    {
        return $this->attachmentId;
    }

    /**
     * @param mixed $attachmentId
     */
    public function setAttachmentId($attachmentId)
    {
        $this->attachmentId = $attachmentId;
    }

    /**
     * @return mixed
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @param mixed $merchantReference
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}