<?php


namespace Bunq\Setup;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class SessionServer extends BunqObject
{
    /**
     * Request attributes:
     */
    private $endpoint;
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
     */
    public function serializeData(BunqResponse $response)
    {
        $this->id = json_decode($response->getBodyString())->{'Response'}[0]->{'Id'};
        $this->token = json_decode($response->getBodyString())->{'Response'}[1]->{'Token'};
        $this->userCompany = json_decode($response->getBodyString())->{'Response'}[2]->{'UserCompany'};
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }
}