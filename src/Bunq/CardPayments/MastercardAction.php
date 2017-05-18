<?php

namespace Bunq\CardPayments;

require '../vendor/autoload.php';

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;

class MastercardAction extends BunqObject
{
    /**
     * Request attributes:
     */

    /**
     * Response attributes:
     */
    private $monetaryAccountId;
    private $cardId;
    private $amountLocal;
    private $amountBilling;
    private $amountOriginalLocal;
    private $amountOriginalBilling;
    private $amountFee;
    private $decision;
    private $decisionDescription;
    private $decisionDescriptionTranslated;
    private $description;
    private $authorisationStatus;
    private $authorisationType;
    private $city;
    private $alias;
    private $counterPartyAlias;
    private $labelCard;
    private $tokenStatus;
    private $reservationExpiryTime;
    private $appliedLimit;
    private $allowChat;

    public function serializeData(BunqResponse $response, $method)
    {
        if($method === 'GET') {
            $this->monetaryAccountId = json_decode($response->getBodyString())->{'Response'}[0]->{'monetary_account_id'};
            $this->cardId = json_decode($response->getBodyString())->{'Response'}[1]->{'card_id'};
            $this->amountLocal = json_decode($response->getBodyString())->{'Response'}[2]->{'amount_local'};
            $this->amountBilling = json_decode($response->getBodyString())->{'Response'}[3]->{'amount_billing'};
            $this->amountOriginalLocal = json_decode($response->getBodyString())->{'Response'}[4]->{'amount_original_local'};
            $this->amountOriginalBilling = json_decode($response->getBodyString())->{'Response'}[5]->{'amount_original_billing'};
            $this->amountFee = json_decode($response->getBodyString())->{'Response'}[6]->{'amount_fee'};
            $this->decision = json_decode($response->getBodyString())->{'Response'}[7]->{'decision'};
            $this->decisionDescription = json_decode($response->getBodyString())->{'Response'}[8]->{'decision_description'};
            $this->decisionDescriptionTranslated = json_decode($response->getBodyString())->{'Response'}[9]->{'decision_description_translated'};
            $this->description = json_decode($response->getBodyString())->{'Response'}[10]->{'description'};
            $this->authorisationStatus = json_decode($response->getBodyString())->{'Response'}[11]->{'authorisation_status'};
            $this->authorisationType = json_decode($response->getBodyString())->{'Response'}[12]->{'authorisation_type'};
            $this->city = json_decode($response->getBodyString())->{'Response'}[13]->{'city'};
            $this->alias = json_decode($response->getBodyString())->{'Response'}[14]->{'alias'};
            $this->counterPartyAlias = json_decode($response->getBodyString())->{'Response'}[15]->{'counterparty_alias'};
            $this->labelCard = json_decode($response->getBodyString())->{'Response'}[16]->{'label_card'};
            $this->tokenStatus = json_decode($response->getBodyString())->{'Response'}[17]->{'token_status'};
            $this->reservationExpiryTime = json_decode($response->getBodyString())->{'Response'}[18]->{'reservation_expiry_time'};
            $this->appliedLimit = json_decode($response->getBodyString())->{'Response'}[19]->{'applied_limit'};
            $this->allowChat = json_decode($response->getBodyString())->{'Response'}[20]->{'allow_chat'};
        }
    }

    /**
     * @return mixed
     */
    public function getMonetaryAccountId()
    {
        return $this->monetaryAccountId;
    }

    /**
     * @param mixed $monetaryAccountId
     */
    public function setMonetaryAccountId($monetaryAccountId)
    {
        $this->monetaryAccountId = $monetaryAccountId;
    }

    /**
     * @return mixed
     */
    public function getCardId()
    {
        return $this->cardId;
    }

    /**
     * @param mixed $cardId
     */
    public function setCardId($cardId)
    {
        $this->cardId = $cardId;
    }

    /**
     * @return mixed
     */
    public function getAmountLocal()
    {
        return $this->amountLocal;
    }

    /**
     * @param mixed $amountLocal
     */
    public function setAmountLocal($amountLocal)
    {
        $this->amountLocal = $amountLocal;
    }

    /**
     * @return mixed
     */
    public function getAmountBilling()
    {
        return $this->amountBilling;
    }

    /**
     * @param mixed $amountBilling
     */
    public function setAmountBilling($amountBilling)
    {
        $this->amountBilling = $amountBilling;
    }

    /**
     * @return mixed
     */
    public function getAmountOriginalLocal()
    {
        return $this->amountOriginalLocal;
    }

    /**
     * @param mixed $amountOriginalLocal
     */
    public function setAmountOriginalLocal($amountOriginalLocal)
    {
        $this->amountOriginalLocal = $amountOriginalLocal;
    }

    /**
     * @return mixed
     */
    public function getAmountOriginalBilling()
    {
        return $this->amountOriginalBilling;
    }

    /**
     * @param mixed $amountOriginalBilling
     */
    public function setAmountOriginalBilling($amountOriginalBilling)
    {
        $this->amountOriginalBilling = $amountOriginalBilling;
    }

    /**
     * @return mixed
     */
    public function getAmountFee()
    {
        return $this->amountFee;
    }

    /**
     * @param mixed $amountFee
     */
    public function setAmountFee($amountFee)
    {
        $this->amountFee = $amountFee;
    }

    /**
     * @return mixed
     */
    public function getDecision()
    {
        return $this->decision;
    }

    /**
     * @param mixed $decision
     */
    public function setDecision($decision)
    {
        $this->decision = $decision;
    }

    /**
     * @return mixed
     */
    public function getDecisionDescription()
    {
        return $this->decisionDescription;
    }

    /**
     * @param mixed $decisionDescription
     */
    public function setDecisionDescription($decisionDescription)
    {
        $this->decisionDescription = $decisionDescription;
    }

    /**
     * @return mixed
     */
    public function getDecisionDescriptionTranslated()
    {
        return $this->decisionDescriptionTranslated;
    }

    /**
     * @param mixed $decisionDescriptionTranslated
     */
    public function setDecisionDescriptionTranslated($decisionDescriptionTranslated)
    {
        $this->decisionDescriptionTranslated = $decisionDescriptionTranslated;
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
    public function getAuthorisationStatus()
    {
        return $this->authorisationStatus;
    }

    /**
     * @param mixed $authorisationStatus
     */
    public function setAuthorisationStatus($authorisationStatus)
    {
        $this->authorisationStatus = $authorisationStatus;
    }

    /**
     * @return mixed
     */
    public function getAuthorisationType()
    {
        return $this->authorisationType;
    }

    /**
     * @param mixed $authorisationType
     */
    public function setAuthorisationType($authorisationType)
    {
        $this->authorisationType = $authorisationType;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getCounterPartyAlias()
    {
        return $this->counterPartyAlias;
    }

    /**
     * @param mixed $counterPartyAlias
     */
    public function setCounterPartyAlias($counterPartyAlias)
    {
        $this->counterPartyAlias = $counterPartyAlias;
    }

    /**
     * @return mixed
     */
    public function getLabelCard()
    {
        return $this->labelCard;
    }

    /**
     * @param mixed $labelCard
     */
    public function setLabelCard($labelCard)
    {
        $this->labelCard = $labelCard;
    }

    /**
     * @return mixed
     */
    public function getTokenStatus()
    {
        return $this->tokenStatus;
    }

    /**
     * @param mixed $tokenStatus
     */
    public function setTokenStatus($tokenStatus)
    {
        $this->tokenStatus = $tokenStatus;
    }

    /**
     * @return mixed
     */
    public function getReservationExpiryTime()
    {
        return $this->reservationExpiryTime;
    }

    /**
     * @param mixed $reservationExpiryTime
     */
    public function setReservationExpiryTime($reservationExpiryTime)
    {
        $this->reservationExpiryTime = $reservationExpiryTime;
    }

    /**
     * @return mixed
     */
    public function getAppliedLimit()
    {
        return $this->appliedLimit;
    }

    /**
     * @param mixed $appliedLimit
     */
    public function setAppliedLimit($appliedLimit)
    {
        $this->appliedLimit = $appliedLimit;
    }

    /**
     * @return mixed
     */
    public function getAllowChat()
    {
        return $this->allowChat;
    }

    /**
     * @param mixed $allowChat
     */
    public function setAllowChat($allowChat)
    {
        $this->allowChat = $allowChat;
    }
}