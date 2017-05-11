<?php

namespace Bunq\MonetaryAccounts;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class MonetaryAccountBank extends BunqObject
{
    /**
     * Request attributes:
     */
    private $currency;              //Required
    private $description;
    private $dailyLimitValue;       //Required
    private $dailyLimitCurrency;    //Required
    private $avatarUuid;
    private $status;
    private $substatus;
    private $reason;
    private $reasonDescription;
    private $notificationFiltersNotificationDeliveryMethod;     //Required
    private $notificationFiltersNotificationTarget;             //Required
    private $notificationFiltersCategory;                       //Required
    private $settingColor;
    private $settingDefaultAvatarStatus;
    private $settingRestrictionChat;


    /**
     * Response attributes:
     */
    private $monetaryAccountBank;

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     * @param $method String the http method used to get the response.
     */
    public function serializeData(BunqResponse $response, $method)
    {
        //Since the responses for the POST, PUT and GET methods are the same, $method can be ignored.
        $this->monetaryAccountBank = json_decode($response->getBodyString())->{'Response'}[0]->{'MonetaryAccountBank'};
    }

}