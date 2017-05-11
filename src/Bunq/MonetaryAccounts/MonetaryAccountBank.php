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

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDailyLimitValue()
    {
        return $this->dailyLimitValue;
    }

    /**
     * @param mixed $dailyLimitValue
     */
    public function setDailyLimitValue($dailyLimitValue)
    {
        $this->dailyLimitValue = $dailyLimitValue;
    }

    /**
     * @return mixed
     */
    public function getDailyLimitCurrency()
    {
        return $this->dailyLimitCurrency;
    }

    /**
     * @param mixed $dailyLimitCurrency
     */
    public function setDailyLimitCurrency($dailyLimitCurrency)
    {
        $this->dailyLimitCurrency = $dailyLimitCurrency;
    }

    /**
     * @return mixed
     */
    public function getAvatarUuid()
    {
        return $this->avatarUuid;
    }

    /**
     * @param mixed $avatarUuid
     */
    public function setAvatarUuid($avatarUuid)
    {
        $this->avatarUuid = $avatarUuid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getSubstatus()
    {
        return $this->substatus;
    }

    /**
     * @param mixed $substatus
     */
    public function setSubstatus($substatus)
    {
        $this->substatus = $substatus;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return mixed
     */
    public function getReasonDescription()
    {
        return $this->reasonDescription;
    }

    /**
     * @param mixed $reasonDescription
     */
    public function setReasonDescription($reasonDescription)
    {
        $this->reasonDescription = $reasonDescription;
    }

    /**
     * @return mixed
     */
    public function getNotificationFiltersNotificationDeliveryMethod()
    {
        return $this->notificationFiltersNotificationDeliveryMethod;
    }

    /**
     * @param mixed $notificationFiltersNotificationDeliveryMethod
     */
    public function setNotificationFiltersNotificationDeliveryMethod($notificationFiltersNotificationDeliveryMethod)
    {
        $this->notificationFiltersNotificationDeliveryMethod = $notificationFiltersNotificationDeliveryMethod;
    }

    /**
     * @return mixed
     */
    public function getNotificationFiltersNotificationTarget()
    {
        return $this->notificationFiltersNotificationTarget;
    }

    /**
     * @param mixed $notificationFiltersNotificationTarget
     */
    public function setNotificationFiltersNotificationTarget($notificationFiltersNotificationTarget)
    {
        $this->notificationFiltersNotificationTarget = $notificationFiltersNotificationTarget;
    }

    /**
     * @return mixed
     */
    public function getNotificationFiltersCategory()
    {
        return $this->notificationFiltersCategory;
    }

    /**
     * @param mixed $notificationFiltersCategory
     */
    public function setNotificationFiltersCategory($notificationFiltersCategory)
    {
        $this->notificationFiltersCategory = $notificationFiltersCategory;
    }

    /**
     * @return mixed
     */
    public function getSettingColor()
    {
        return $this->settingColor;
    }

    /**
     * @param mixed $settingColor
     */
    public function setSettingColor($settingColor)
    {
        $this->settingColor = $settingColor;
    }

    /**
     * @return mixed
     */
    public function getSettingDefaultAvatarStatus()
    {
        return $this->settingDefaultAvatarStatus;
    }

    /**
     * @param mixed $settingDefaultAvatarStatus
     */
    public function setSettingDefaultAvatarStatus($settingDefaultAvatarStatus)
    {
        $this->settingDefaultAvatarStatus = $settingDefaultAvatarStatus;
    }

    /**
     * @return mixed
     */
    public function getSettingRestrictionChat()
    {
        return $this->settingRestrictionChat;
    }

    /**
     * @param mixed $settingRestrictionChat
     */
    public function setSettingRestrictionChat($settingRestrictionChat)
    {
        $this->settingRestrictionChat = $settingRestrictionChat;
    }

    /**
     * @return mixed
     */
    public function getMonetaryAccountBank()
    {
        return $this->monetaryAccountBank;
    }

    /**
     * @param mixed $monetaryAccountBank
     */
    public function setMonetaryAccountBank($monetaryAccountBank)
    {
        $this->monetaryAccountBank = $monetaryAccountBank;
    }
}