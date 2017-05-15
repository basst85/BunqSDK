<?php

namespace Bunq\Invoices;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class InvoiceByUser extends BunqObject
{
    /**
     * Response attributes:
     */
    private $invoice;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'GET') {
            $this->invoice = json_decode($response->getBodyString())->{'Response'}[0]->{'Invoice'};
        }
    }
}