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
}