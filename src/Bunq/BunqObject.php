<?php

namespace Bunq;

/**
 * Class BunqObject
 * Abstract class for API endpoint objects.
 * @package Bunq
 */
abstract class BunqObject
{
    /**
     * @return array the request body as an array.
     */
    public abstract function getRequestBodyArray();

    /**
     * Extracts the response data and stores them in the class fields.
     */
    public abstract function serializeData();
}