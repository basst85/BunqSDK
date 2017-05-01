<?php

namespace Bunq\Client\HttpClients;

/**
 * Class BunqHttpClientInterface
 * Interface for Bunq HTTP clients.
 * @package Bunq\Client\HttpClients
 */

interface BunqHttpClientInterface
{
    /**
     * Sends a request to the server and returns the raw response.
     *
     * @param $url string      The endpoint to which the request is sent to.
     * @param $method string   The request method.
     * @param $body string     The request body.
     * @param $headers array   The request headers.
     *
     * @return \Bunq\Client\Http\BunqRawResponse
     *
     * @throws \Bunq\Exceptions\BunqSDKException
     */
    public function send($url, $method, $body, array $headers);
}