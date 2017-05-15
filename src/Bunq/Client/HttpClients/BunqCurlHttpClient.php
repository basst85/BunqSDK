<?php

namespace Bunq\Client\HttpClients;

require '../vendor/autoload.php';

use Bunq\Exceptions\BunqSDKException;
use Bunq\Client\Http\BunqRawResponse;

/**
 * Class BunqCurlHttpClient
 * Client used to send the request to the server.
 * @package Bunq\Client\HttpClients
 */

class BunqCurlHttpClient implements BunqHttpClientInterface
{
    /**
     * Procedural curl as object.
     *
     * @var BunqCurl
     */
    protected $bunqCurl;

    /**
     * Raw response.
     *
     * @var string|boolean
     */
    protected $rawResponse;

    /**
     * BunqCurlHttpClient constructor.
     * @param BunqCurl|null $bunqCurl
     */
    public function __construct(BunqCurl $bunqCurl = null)
    {
        $this->bunqCurl = $bunqCurl ?: new BunqCurl();
    }

    /**
     * @inheritdoc
     */
    public function send($url, $method, $body, array $headers)
    {
        $this->openConnection($url, $method, $body, $headers);
        $this->sendRequest();

        $headerSize = $this->bunqCurl->getinfo(CURLINFO_HEADER_SIZE);
        $responseStatusCode = $this->bunqCurl->getinfo(CURLINFO_HTTP_CODE);
        $responseHeaderString = substr($this->rawResponse, 0, $headerSize);
        $responseBodyString = substr($this->rawResponse, $headerSize);

        $this->bunqCurl->close();

        $outputDecoded = json_decode($responseBodyString);

        if ($outputDecoded) {
            if (isset($outputDecoded->{'Error'})) {
                $message = 'Url: ' . $url . PHP_EOL . 'Errors: ' . PHP_EOL;

                foreach ($outputDecoded->{'Error'} as $key => $error) {
                    $message .= ($key + 1) . '. ' . $error->{'error_description'} . PHP_EOL;
                }

                throw new BunqSDKException($message);
            }
        }

        return new BunqRawResponse($responseHeaderString, $responseBodyString, $responseStatusCode);
    }

    /**
     * Opens a new curl connection.
     *
     * @param $url string       The request url.
     * @param $method string    The request method.
     * @param $body string      The request body.
     * @param $headers array    The request headers in array format.
     */
    public function openConnection($url, $method, $body, array $headers)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HEADER => true,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $this->getCurlHeaders($headers),
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $body;
        }
        elseif ($method === 'PUT') {
            $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
            $options[CURLOPT_POSTFIELDS] = $body;
        }
        elseif ($method === 'DELETE') {
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        }

        $this->bunqCurl->init();
        $this->bunqCurl->setoptArray($options);
    }

    /**
     * Closes the curl connection.
     */
    public function closeConnection()
    {
        $this->bunqCurl->close();
    }

    public function sendRequest()
    {
        $this->rawResponse = $this->bunqCurl->exec();
    }

    /**
     * Create headers in the curl-specific format.
     *
     * @param $headers
     * @return array
     */
    private function getCurlHeaders($headers)
    {
        $curlHeaders = [];

        foreach($headers as $key => $value) {
            $curlHeaders[] = $key . ': ' . $value;
        }

        return $curlHeaders;
    }
}