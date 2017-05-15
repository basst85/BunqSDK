<?php

namespace Bunq\Invoices;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class Invoice extends BunqObject
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

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }


}