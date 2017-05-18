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
            $this->cardId = json_decode($response->getBodyString())->{'Response'}[0]->{'card_id'};
            $this->amountLocal = json_decode($response->getBodyString())->{'Response'}[0]->{'amount_local'};
            $this->amountBilling = json_decode($response->getBodyString())->{'Response'}[0]->{'amount_billing'};
            $this->amountOriginalLocal = json_decode($response->getBodyString())->{'Response'}[0]->{'amount_original_local'};
            $this->amountOriginalBilling = json_decode($response->getBodyString())->{'Response'}[0]->{'amount_original_billing'};
            $this->amountFee = json_decode($response->getBodyString())->{'Response'}[0]->{'amount_fee'};
            $this->decision = json_decode($response->getBodyString())->{'Response'}[0]->{'decision'};
            $this->decisionDescription = json_decode($response->getBodyString())->{'Response'}[0]->{'decision_description'};
            $this->decisionDescriptionTranslated = json_decode($response->getBodyString())->{'Response'}[0]->{'decision_description_translated'};
            $this->description = json_decode($response->getBodyString())->{'Response'}[0]->{'description'};
            $this->authorisationStatus = json_decode($response->getBodyString())->{'Response'}[0]->{'authorisation_status'};
            $this->authorisationType = json_decode($response->getBodyString())->{'Response'}[0]->{'authorisation_type'};
            $this->city = json_decode($response->getBodyString())->{'Response'}[0]->{'city'};
            $this->alias = json_decode($response->getBodyString())->{'Response'}[0]->{'alias'};
            $this->counterPartyAlias = json_decode($response->getBodyString())->{'Response'}[0]->{'counterparty_alias'};
            $this->labelCard = json_decode($response->getBodyString())->{'Response'}[0]->{'label_card'};
            $this->tokenStatus = json_decode($response->getBodyString())->{'Response'}[0]->{'token_status'};
            $this->reservationExpiryTime = json_decode($response->getBodyString())->{'Response'}[0]->{'reservation_expiry_time'};
            $this->appliedLimit = json_decode($response->getBodyString())->{'Response'}[0]->{'applied_limit'};
            $this->allowChat = json_decode($response->getBodyString())->{'Response'}[0]->{'allow_chat'};
        }
    }
}