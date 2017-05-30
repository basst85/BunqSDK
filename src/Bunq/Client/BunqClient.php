<?php


namespace Bunq\Client;

use Bunq\Client\HttpClients\BunqCurlHttpClient;
use Bunq\Client\HttpClients\BunqHttpClientInterface;

/**
 * Class BunqClient
 * Client used to send requests to te API.
 * @package Bunq\Client
 */

class BunqClient
{
    /**
     * The serviceUrl is the base URL of the API.
     * The apiVersion is the version of the API.
     */
    const BUNQ_API_SERVICE_URL = 'https://sandbox.public.api.bunq.com';
    const BUNQ_API_VERSION = 'v1';

    /**
     * The Signature Algorithm used is SHA256. (php: http://php.net/manual/en/function.openssl-sign.php#signature_alg)
     */
    const SIGNATURE_ALGORITHM = OPENSSL_ALGO_SHA256;

    /**
     * Http client handler for handling the requests.
     *
     * @var BunqHttpClientInterface
     */
    private $httpClientHandler;

    /**
     * BunqClient constructor.
     *
     * @param BunqHttpClientInterface|null $httpClientHandler
     */
    public function __construct(BunqHttpClientInterface $httpClientHandler = null)
    {
        $this->httpClientHandler = $httpClientHandler ?: new BunqCurlHttpClient();
    }

    /**
     * Prepares the request to be send to the httpClientHandler.
     *
     * @param BunqRequest $request
     * @return array
     */
    public function prepareRequestMessage(BunqRequest $request)
    {
        //The url is the serviceUrl, apiVersion and endpoint separated by a '/'.
        $url = self::BUNQ_API_SERVICE_URL . '/' . self::BUNQ_API_VERSION . '/' . $request->getEndpoint();

        return [
            $url,
            $request->getMethod(),
            $request->getHeaders(),
            $request->getBody(),
        ];
    }

    /**
     * Makes the request to the httpClientHandler and returns the result.
     *
     * @param BunqRequest $request
     * @return BunqResponse
     */
    public function SendRequest(BunqRequest $request)
    {
        list($url, $method, $headers, $body) = $this->prepareRequestMessage($request);
        $rawResponse = $this->httpClientHandler->send($url, $method, $body, $headers);

        return new BunqResponse(
            $rawResponse->getBody(),
            $rawResponse->getHeaders(),
            $rawResponse->getHttpStatusCode(),
            $request
        );
    }

    /**
     * Returns the signature. The signature should be added to the X-Bunq-Client-Signature header.
     *
     * @param string $clientPrivateKey The private key corresponding to the client_public_key you provided in the
     * installation call.
     *
     * @param BunqRequest $request The request needed for the signature.
     *
     * @return string The result of the signing after we base64 encoded it. This can be used in the headers of the
     * request.
     */
    public function getRequestSignature(BunqRequest $request, $clientPrivateKey)
    {
        //The headers should be in alphabetical order when signing.
        $headers = $request->getHeaders();
        ksort($headers);

        //The first line of string that needs to be signed is for example: POST /v1/installation.
        $toSign = $request->getMethod() . ' ' . '/' . self::BUNQ_API_VERSION . '/' . $request->getEndpoint();

        foreach ($headers as $key => $value) {
            //Not all headers should be signed.
            //The User-Agent and Cash-Control headers need to be signed.
            if ($key === 'User-Agent' || $key === 'Cache-Control') {
                $toSign .= PHP_EOL . $key . ': ' . $value;
            }

            //All headers with the prefix 'X-Bunq-' need to be signed.
            if (substr($key, 0, 7) === 'X-Bunq-') {
                $toSign .= PHP_EOL . $key . ': ' . $value;
            }
        }

        //Always add two newlines after the headers.
        $toSign .= PHP_EOL . PHP_EOL;

        //If we have a body in this request: add the body to the string that needs to be signed.
        if (!is_null($request->getBody())) {
            $toSign .= $request->getBody();
        }

        openssl_sign($toSign, $signature, $clientPrivateKey, self::SIGNATURE_ALGORITHM);

        //Don't forget to base64 encode the signature.
        return base64_encode($signature);
    }

    public function verifyResponseSignature(BunqResponse $response, $serverPublicKey)
    {
        //Create the headers which should be signed.
        $headersToSign = '';

        //The Apache headers end in \r\n..
        $responseHeadersArray = explode("\r\n", $response->getHeaderString());

        foreach ($responseHeadersArray as $oneHeaderLine) {
            if (strstr($oneHeaderLine, 'X-Bunq') && !strstr($oneHeaderLine, 'X-Bunq-Server-Signature')) {
                $headersToSign[] = $oneHeaderLine;
            }
        }

        //Sort the headers.
        sort($headersToSign);

        //Create the signed string.
        $signedString = $response->getStatusCode() . "\n";
        $signedString .= implode("\n", $headersToSign);
        $signedString .= "\n\n";
        $signedString .= $response->getBodyString();

        //Extract the signature from the response headers.
        $serverSignatureBase64Encoded = '';

        foreach ($responseHeadersArray as $oneHeaderLine) {
            if (stristr($oneHeaderLine, 'X-Bunq-Server-Signature')) {
                // Remove the header name to get only the signature string.
                $serverSignatureBase64Encoded = str_replace('X-Bunq-Server-Signature: ', '', $oneHeaderLine);
            }
        }

        $serverSignature = base64_decode($serverSignatureBase64Encoded);

        //Return the openssl verification result.
        return openssl_verify($signedString, $serverSignature, $serverPublicKey, OPENSSL_ALGO_SHA256);
    }



}