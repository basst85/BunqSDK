<?php
/**
 * Created by PhpStorm.
 * User: jelle
 * Date: 30/05/2017
 * Time: 21:19
 */

namespace Bunq\Requests;

use Bunq\BunqObject;
use Bunq\Exceptions\BunqObjectException;

class RequestInquiryBatch extends BunqObject
{
    /**
     * Request attributes:
     */
    private $requestInquiriesRequest;
    private $status;
    private $totalAmountInquiredRequest;

    /**
     * Response attributes:
     */
    private $requestInquiriesResponse;
    private $totalAmountInquiredResponse;

    public function getRequestBodyArray()
    {
        if(is_null($this->requestInquiriesRequest) ||
        is_null($this->totalAmountInquiredRequest)) {
            throw new BunqObjectException('Missing required attributes');
        }
        else {
            $requestBodyArray = ['request_inquiries' => $this->requestInquiriesRequest,
                                'total_amount_inquired' => $this->totalAmountInquiredRequest];

            if(!is_null($this->status)) {
                $requestBodyArray['status'] = $this->status;
            }
        }

        return $requestBodyArray;
    }

    public function serializeData(BunqResponse $response, $method)
    {
        //Since the responses for the different HTTP methods are the same, $method can be ignored.
        $this->requestInquiriesResponse = json_decode($response->getBodyString())->{'Response'}[0]->{'request_inquiries'};
        $this->totalAmountInquiredResponse = json_decode($response->getBodyString())->{'Response'}[1]->{'total_amount_inquired'};
    }

    /**
     * @return mixed
     */
    public function getRequestInquiriesRequest()
    {
        return $this->requestInquiriesRequest;
    }

    /**
     * @param mixed $requestInquiriesRequest
     */
    public function setRequestInquiriesRequest($requestInquiriesRequest)
    {
        $this->requestInquiriesRequest = $requestInquiriesRequest;
    }

    /**
     * @return mixed
     */
    public function getStatusRequest()
    {
        return $this->statusRequest;
    }

    /**
     * @param mixed $statusRequest
     */
    public function setStatusRequest($statusRequest)
    {
        $this->statusRequest = $statusRequest;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountInquiredRequest()
    {
        return $this->totalAmountInquiredRequest;
    }

    /**
     * @param mixed $totalAmountInquiredRequest
     */
    public function setTotalAmountInquiredRequest($totalAmountInquiredRequest)
    {
        $this->totalAmountInquiredRequest = $totalAmountInquiredRequest;
    }

    /**
     * @return mixed
     */
    public function getRequestInquiriesResponse()
    {
        return $this->requestInquiriesResponse;
    }

    /**
     * @param mixed $requestInquiriesResponse
     */
    public function setRequestInquiriesResponse($requestInquiriesResponse)
    {
        $this->requestInquiriesResponse = $requestInquiriesResponse;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountInquiredResponse()
    {
        return $this->totalAmountInquiredResponse;
    }

    /**
     * @param mixed $totalAmountInquiredResponse
     */
    public function setTotalAmountInquiredResponse($totalAmountInquiredResponse)
    {
        $this->totalAmountInquiredResponse = $totalAmountInquiredResponse;
    }
}