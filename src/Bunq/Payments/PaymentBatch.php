<?php

namespace Bunq\Payments;

require '../vendor/autoload.php';

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

    public function serializeData(BunqResponse $response, $method)
    {
        //Since the responses for the different HTTP methods are the same, $method can be ignored.
        $this->responsePayments = json_decode($response->getBodyString())->{'Response'}[0]->{'payments'};
    }
}