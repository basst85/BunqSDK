<?php

namespace Bunq\Payments;

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class PaymentBatch extends BunqObject
{
    /**
     * Request attributes:
     */
    private $requestPayments;

    /**
     * Respone attributes:
     */
    private $responsePayments;

    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->requestPayments)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {
            $requestBodyArray = ['payments' => $this->requestPayments];
        }

        return $requestBodyArray;
    }

    /**
     * @param BunqResponse $response
     * @param String $method
     */
    public function serializeData(BunqResponse $response, $method)
    {
        //Since the responses for the different HTTP methods are the same, $method can be ignored.
        $this->responsePayments = json_decode($response->getBodyString())->{'Response'}[0]->{'PaymentBatch'};
    }

    /**
     * @return mixed
     */
    public function getRequestPayments()
    {
        return $this->requestPayments;
    }

    /**
     * @param mixed $requestPayments
     */
    public function setRequestPayments($requestPayments)
    {
        $this->requestPayments = $requestPayments;
    }

    /**
     * @return mixed
     */
    public function getResponsePayments()
    {
        return $this->responsePayments;
    }

    /**
     * @param mixed $responsePayments
     */
    public function setResponsePayments($responsePayments)
    {
        $this->responsePayments = $responsePayments;
    }
}