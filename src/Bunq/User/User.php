<?php

namespace Bunq\User;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class User extends BunqObject
{

    /**
     * Request attributes:
     */

    /**
     * Response attributes:
     */
    private $userCompany;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'GET') {
            $this->userCompany = json_decode($response->getBodyString())->{'Response'}[0]->{'UserCompany'};
        }
    }

    /**
     * @return mixed
     */
    public function getUserCompany()
    {
        return $this->userCompany;
    }

    /**
     * @param mixed $userCompany
     */
    public function setUserCompany($userCompany)
    {
        $this->userCompany = $userCompany;
    }
}