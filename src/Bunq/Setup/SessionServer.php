<?php


namespace Bunq\Setup;

include_once('BunqObject.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');

use Bunq\BunqObject;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;

class SessionServer extends BunqObject
{
    /**
     * Request attributes:
     */
    private $endpoint;
    private $secret;

    /**
     * Response attributes:
     */
    private $id;

    private $tokenId;
    private $token;

    private $userCompanyId;
    private $userCompanyCreated;
    private $userCompanyUpdated;
    private $userCompanyPublicUuid;
    private $userCompanyName;
    private $userCompanyDisplayName;
    private $userCompanyPublicNickName;
    private $userCompanyChamberOfCommerceNumber;
    private $userCompanyTypeOfBusinessEntity;
    private $userCompanySectorOfIndustry;
    private $userCompanyCounterBankIban;
    private $userCompanyVersionTermsOfService;
    private $userCompanyLanguage;
    private $userCompanyRegion;
    private $userCompanyStatus;
    private $userCompanySubStatus;
    private $userCompanySessionTimeout;

    private $userCompanyAliasType;
    private $userCompanyAliasValue;
    private $userCompanyAliasName;

    private $userCompanyAvatarUuid;
    private $userCompanyAvatarAnchorUuid;
    private $userCompanyAvatarImage;

    private $userCompanyAvatarImageAttachmentPublicUuid;
    private $userCompanyAvatarImageContentType;
    private $userCompanyAvatarImageHeight;
    private $userCompanyAvatarImageWidth;

    private $userCompanyAddressMainStreet;
    private $userCompanyAddressMainHouseNumber;
    private $userCompanyAddressMainPoBox;
    private $userCompanyAddressMainPostalCode;
    private $userCompanyAddressMainCity;
    private $userCompanyAddressMainCountry;

    private $userCompanyAddressPostalStreet;
    private $userCompanyAddressPostalHouseNumber;
    private $userCompanyAddressPostalPoBox;
    private $userCompanyAddressPostalPostalCode;
    private $userCompanyAddressPostalCity;
    private $userCompanyAddressPostalCountry;

    private $userCompanyDirectorAliasUuid;
    private $userCompanyDirectorAliasPublicNickName;
    private $userCompanyDirectorAliasDisplayName;
    private $userCompanyDirectorAliasCountry;

    private $userCompanyDirectorAliasAvatarUuid;
    private $userCompanyDirectorAliasAvatarAnchorId;

    private $userCompanyDirectorAliasAvatarImageAttachmentPublicUuid;
    private $userCompanyDirectorAliasAvatarImageContentType;
    private $userCompanyDirectorAliasAvatarImageHeight;
    private $userCompanyDirectorAliasAvatarImageWidth;

    private $userCompanyUboName;
    private $userCompanyUboDateOfBirth;
    private $userCompanyUboNatiolality;

    private $userCompanyDailyLimitWithoutConformationLoginValue;
    private $userCompanyDailyLimitWithoutConformationLoginCurrency;

    private $userCompanyNotificationFiltersNotificationDeliveryMethod;
    private $userCompanyNotificationFiltersNotificationTarget;
    private $userCompanyNotificationFiltersCategory;



    /**
     * @return array the request body as an array.
     * @throws BunqObjectException thrown if the required attributes are missing.
     */
    public function getRequestBodyArray()
    {
        if(is_null($this->secret)) {
            throw new BunqObjectException('Missing required attributes.');
        }
        else {
            return ['secret' => $this->secret];
        }
    }

    /**
     * Extracts the response data and stores them in the class fields.
     * @param BunqResponse $response the response returned by the server.
     */
    public function serializeData(BunqResponse $response)
    {
        // TODO: Implement serializeData() method.
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        // TODO: Implement getEndpoint() method.
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        // TODO: Implement setEndpoint() method.
    }
}