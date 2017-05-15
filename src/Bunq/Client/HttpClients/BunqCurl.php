<?php

namespace Bunq\Client\HttpClients;

require '../vendor/autoload.php';

/**
 * Class BunqCurl
 * Abstraction for the curl elements so that curl can be mocked and implemented.
 * @package Bunq\Client\HttpClients
 */

class BunqCurl
{
    /**
     * @var resource Curl: resource instance.
     */
    protected $curl;

    /**
     * Initialize the curl instance.
     */
    public function init()
    {
        $this->curl = curl_init();
    }

    /**
     * Set a curl option.
     * @param $key
     * @param $value
     */
    public function setopt($key, $value)
    {
        curl_setopt($this->curl, $key, $value);
    }

    /**
     * Set an array of curl options.
     * @param array $options
     */
    public function setoptArray(array $options)
    {
        curl_setopt_array($this->curl, $options);
    }

    /**
     * Execute a curl request.
     * @return mixed
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }

    /**
     * Return the curl error code.
     * @return int
     */
    public function errno()
    {
        return curl_errno($this->curl);
    }

    /**
     * Return the curl error message.
     * @return string
     */
    public function error()
    {
        return curl_error($this->curl);
    }

    /**
     * Get info from curl.
     * @param $type
     * @return mixed
     */
    public function getinfo($type)
    {
        return curl_getinfo($this->curl, $type);
    }

    /**
     * Close the curl connection.
     */
    public function close()
    {
        curl_close($this->curl);
    }
}