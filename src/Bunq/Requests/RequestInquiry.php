<?php

namespace Bunq\Requests;

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class RequestInquiry extends BunqObject
{
    /**
     * Request attributes:
     */
    private $amountInquiredValue;
    private $amountInquiredCurrency;
    private $counterPartyAliasType;
    private $counterPartyAliasValue;
    private $counterPartyAliasName;
    private $description;
    private $attachmentId;
    private $merchantReference;
    private $status;
    private $minimumAge;
    private $requireAddress;
    private $allowBunqMe;
    private $redirectUrl;

    /**
     * Response attributes:
     */
    private $id;
    private $requestInquiry;

    public function getRequestBodyArray()
    {
        if(is_null($this->amountInquiredValue) ||
        is_null($this->amountInquiredCurrency) ||
        is_null($this->counterPartyAliasType) ||
        is_null($this->counterPartyAliasValue) ||
        is_null($this->description) ||
        is_null($this->allowBunqMe)) {
            if(is_null($this->status)) {
                throw new BunqObjectException('Missing required attributes.');
            }
            else {
                //In this case, the request must be of the method PUT.
                $requestBodyArray = ['status' => $this->status];
            }
        }
        else {
            $requestBodyArray = [
                'amount_inquired' => [
                    'value' => $this->amountInquiredValue,
                    'currency' => $this->amountInquiredCurrency
                    ],
                'counterparty_alias' => [
                    'type' => $this->counterPartyAliasType,
                    'value' => $this->counterPartyAliasValue
                    ],
                'description' => $this->description,
                'allow_bunqme' => $this->allowBunqMe
            ];

            if(!is_null($this->counterPartyAliasName)) {
                $requestBodyArray['counterparty_alias']['name'] = $this->counterPartyAliasName;
            }

            if(!is_null($this->attachmentId)) {
                $requestBodyArray['attachment'] = ['id' => $this->attachmentId];
            }

            if(!is_null($this->merchantReference)) {
                $requestBodyArray['merchant_reference'] = $this->merchantReference;
            }

            if(!is_null($this->status)) {
                $requestBodyArray['status'] = $this->status;
            }

            if(!is_null($this->minimumAge)) {
                $requestBodyArray['minimum_age'] = $this->minimumAge;
            }

            if(!is_null($this->requireAddress)) {
                $requestBodyArray['require_address'] = $this->requireAddress;
            }

            if(!is_null($this->redirectUrl)) {
                $requestBodyArray['redirect_url'] = $this->redirectUrl;
            }
        }

        return $requestBodyArray;
    }

    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'POST') {
            $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};
        }
        if($method === 'PUT' || $method === 'GET') {
            $this->requestInquiry = json_decode($response->getBodyString())->{'Response'}[0]->{'RequestInquiry'};
        }
    }

    /**
     * @return mixed
     */
    public function getAmountInquiredValue()
    {
        return $this->amountInquiredValue;
    }

    /**
     * @param mixed $amountInquiredValue
     */
    public function setAmountInquiredValue($amountInquiredValue)
    {
        $this->amountInquiredValue = $amountInquiredValue;
    }

    /**
     * @return mixed
     */
    public function getAmountInquiredCurrency()
    {
        return $this->amountInquiredCurrency;
    }

    /**
     * @param mixed $amountInquiredCurrency
     */
    public function setAmountInquiredCurrency($amountInquiredCurrency)
    {
        $this->amountInquiredCurrency = $amountInquiredCurrency;
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
    public function getCounterPartyAliasName()
    {
        return $this->counterPartyAliasName;
    }

    /**
     * @param mixed $counterPartyAliasName
     */
    public function setCounterPartyAliasName($counterPartyAliasName)
    {
        $this->counterPartyAliasName = $counterPartyAliasName;
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
    public function getMinimumAge()
    {
        return $this->minimumAge;
    }

    /**
     * @param mixed $minimumAge
     */
    public function setMinimumAge($minimumAge)
    {
        $this->minimumAge = $minimumAge;
    }

    /**
     * @return mixed
     */
    public function getRequireAddress()
    {
        return $this->requireAddress;
    }

    /**
     * @param mixed $requireAddress
     */
    public function setRequireAddress($requireAddress)
    {
        $this->requireAddress = $requireAddress;
    }

    /**
     * @return mixed
     */
    public function getAllowBunqMe()
    {
        return $this->allowBunqMe;
    }

    /**
     * @param mixed $allowBunqMe
     */
    public function setAllowBunqMe($allowBunqMe)
    {
        $this->allowBunqMe = $allowBunqMe;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @param mixed $redirectUrl
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
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

    /**
     * @return mixed
     */
    public function getRequestInquiry()
    {
        return $this->requestInquiry;
    }

    /**
     * @param mixed $requestInquiry
     */
    public function setRequestInquiry($requestInquiry)
    {
        $this->requestInquiry = $requestInquiry;
    }


}