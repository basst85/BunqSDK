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
    private $counterpartyAlias;
    private $labelCard;
    private $tokenStatus;
    private $reservationExpiryTime;
    private $appliedLimit;
    private $allowChat;
}