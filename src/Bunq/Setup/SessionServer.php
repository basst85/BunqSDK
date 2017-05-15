<?php


namespace Bunq\Setup;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class SessionServer extends BunqObject
{
    /**
     * Request attributes:
     */
    private $secret;

    /**
     * Response attributes:
     */
    private $id;

    private $token;

    private $userCompany;

    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->secret)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {
            return ['secret' => $this->secret];
        }
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
            $this->token = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'};
            $this->userCompany = json_decode($response->getBodyString())->{'Response'}[2]->{'UserCompany'};
        }
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
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