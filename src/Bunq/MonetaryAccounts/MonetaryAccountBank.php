<?php

namespace Bunq\MonetaryAccounts;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class MonetaryAccountBank extends BunqObject
{
    /**
     * Request attributes:
     */
    private $currency;
    private $description;
    private $dailyLimitValue;
    private $dailyLimitCurrency;
    private $avatarUuid;
    private $status;
    private $subStatus;
    private $reason;
    private $reasonDescription;
    private $notificationFiltersNotificationDeliveryMethod;
    private $notificationFiltersNotificationTarget;
    private $notificationFiltersCategory;
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
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->dailyLimitValue) ||
            is_null($this->dailyLimitCurrency)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {

            $requestBodyArray = [
                'daily_limit' => [
                    'value' => $this->dailyLimitValue,
                    'currency' => $this->dailyLimitCurrency
                ]
            ];

            if(!is_null($this->currency)) {
                $requestBodyArray['currency'] = $this->currency;
            }

            if(!is_null($this->description)) {
                $requestBodyArray['description'] = $this->description;
            }

            if(!is_null($this->avatarUuid)) {
                $requestBodyArray['avatar_uuid'] = $this->avatarUuid;
            }

            if(!is_null($this->status)) {
                $requestBodyArray['status'] = $this->status;
            }

            if(!is_null($this->subStatus)) {
                $requestBodyArray['sub_status'] = $this->subStatus;
            }

            if(!is_null($this->reason)) {
                $requestBodyArray['reason'] = $this->reason;
            }

            if(!is_null($this->reasonDescription)) {
                $requestBodyArray['reason_description'] = $this->reasonDescription;
            }

            if(!is_null($this->notificationFiltersNotificationDeliveryMethod) ||
                !is_null($this->notificationFiltersNotificationTarget) ||
                !is_null($this->notificationFiltersCategory)) {
                $requestBodyArray['notification_filters'] =
                    [
                    'notification_delivery_method' => $this->notificationFiltersNotificationDeliveryMethod,
                    'notification_target' => $this->notificationFiltersNotificationTarget,
                    'category' => $this->notificationFiltersCategory
                    ];
            }

            if(!is_null($this->settingColor) ||
                !is_null($this->settingDefaultAvatarStatus) ||
                !is_null($this->settingRestrictionChat)) {
                $requestBodyArray['setting'] =
                    [
                        'color' => $this->settingColor,
                        'default_avatar_status' => $this->settingDefaultAvatarStatus,
                        'restriction_chat' => $this->settingRestrictionChat
                    ];
            }
        }

        return $requestBodyArray;
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
    public function getSubStatus()
    {
        return $this->subStatus;
    }

    /**
     * @param mixed $subStatus
     */
    public function setSubStatus($subStatus)
    {
        $this->subStatus = $subStatus;
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