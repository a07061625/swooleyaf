<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateMaterial
 *
 * @method string getContactEmail()
 * @method string getContactAddress()
 * @method string getEAddress()
 * @method string getLegalNoticeOssKey()
 * @method string getAddress()
 * @method string getTown()
 * @method string getContactNumber()
 * @method string getCity()
 * @method string getIdCardOssKey()
 * @method string getContactName()
 * @method string getPassportOssKey()
 * @method string getContactZipcode()
 * @method string getEName()
 * @method string getProvince()
 * @method string getBusinessLicenceOssKey()
 * @method string getName()
 * @method string getId()
 * @method string getCardNumber()
 * @method string getLoaId()
 * @method string getLoaOssKey()
 */
class UpdateMaterialRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Trademark', '2018-07-24', 'UpdateMaterial', 'trademark');
    }

    /**
     * @param string $contactEmail
     *
     * @return $this
     */
    public function setContactEmail($contactEmail)
    {
        $this->requestParameters['ContactEmail'] = $contactEmail;
        $this->queryParameters['ContactEmail'] = $contactEmail;

        return $this;
    }

    /**
     * @param string $contactAddress
     *
     * @return $this
     */
    public function setContactAddress($contactAddress)
    {
        $this->requestParameters['ContactAddress'] = $contactAddress;
        $this->queryParameters['ContactAddress'] = $contactAddress;

        return $this;
    }

    /**
     * @param string $eAddress
     *
     * @return $this
     */
    public function setEAddress($eAddress)
    {
        $this->requestParameters['EAddress'] = $eAddress;
        $this->queryParameters['EAddress'] = $eAddress;

        return $this;
    }

    /**
     * @param string $legalNoticeOssKey
     *
     * @return $this
     */
    public function setLegalNoticeOssKey($legalNoticeOssKey)
    {
        $this->requestParameters['LegalNoticeOssKey'] = $legalNoticeOssKey;
        $this->queryParameters['LegalNoticeOssKey'] = $legalNoticeOssKey;

        return $this;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->requestParameters['Address'] = $address;
        $this->queryParameters['Address'] = $address;

        return $this;
    }

    /**
     * @param string $town
     *
     * @return $this
     */
    public function setTown($town)
    {
        $this->requestParameters['Town'] = $town;
        $this->queryParameters['Town'] = $town;

        return $this;
    }

    /**
     * @param string $contactNumber
     *
     * @return $this
     */
    public function setContactNumber($contactNumber)
    {
        $this->requestParameters['ContactNumber'] = $contactNumber;
        $this->queryParameters['ContactNumber'] = $contactNumber;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->requestParameters['City'] = $city;
        $this->queryParameters['City'] = $city;

        return $this;
    }

    /**
     * @param string $idCardOssKey
     *
     * @return $this
     */
    public function setIdCardOssKey($idCardOssKey)
    {
        $this->requestParameters['IdCardOssKey'] = $idCardOssKey;
        $this->queryParameters['IdCardOssKey'] = $idCardOssKey;

        return $this;
    }

    /**
     * @param string $contactName
     *
     * @return $this
     */
    public function setContactName($contactName)
    {
        $this->requestParameters['ContactName'] = $contactName;
        $this->queryParameters['ContactName'] = $contactName;

        return $this;
    }

    /**
     * @param string $passportOssKey
     *
     * @return $this
     */
    public function setPassportOssKey($passportOssKey)
    {
        $this->requestParameters['PassportOssKey'] = $passportOssKey;
        $this->queryParameters['PassportOssKey'] = $passportOssKey;

        return $this;
    }

    /**
     * @param string $contactZipcode
     *
     * @return $this
     */
    public function setContactZipcode($contactZipcode)
    {
        $this->requestParameters['ContactZipcode'] = $contactZipcode;
        $this->queryParameters['ContactZipcode'] = $contactZipcode;

        return $this;
    }

    /**
     * @param string $eName
     *
     * @return $this
     */
    public function setEName($eName)
    {
        $this->requestParameters['EName'] = $eName;
        $this->queryParameters['EName'] = $eName;

        return $this;
    }

    /**
     * @param string $province
     *
     * @return $this
     */
    public function setProvince($province)
    {
        $this->requestParameters['Province'] = $province;
        $this->queryParameters['Province'] = $province;

        return $this;
    }

    /**
     * @param string $businessLicenceOssKey
     *
     * @return $this
     */
    public function setBusinessLicenceOssKey($businessLicenceOssKey)
    {
        $this->requestParameters['BusinessLicenceOssKey'] = $businessLicenceOssKey;
        $this->queryParameters['BusinessLicenceOssKey'] = $businessLicenceOssKey;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->requestParameters['Id'] = $id;
        $this->queryParameters['Id'] = $id;

        return $this;
    }

    /**
     * @param string $cardNumber
     *
     * @return $this
     */
    public function setCardNumber($cardNumber)
    {
        $this->requestParameters['CardNumber'] = $cardNumber;
        $this->queryParameters['CardNumber'] = $cardNumber;

        return $this;
    }

    /**
     * @param string $loaId
     *
     * @return $this
     */
    public function setLoaId($loaId)
    {
        $this->requestParameters['LoaId'] = $loaId;
        $this->queryParameters['LoaId'] = $loaId;

        return $this;
    }

    /**
     * @param string $loaOssKey
     *
     * @return $this
     */
    public function setLoaOssKey($loaOssKey)
    {
        $this->requestParameters['LoaOssKey'] = $loaOssKey;
        $this->queryParameters['LoaOssKey'] = $loaOssKey;

        return $this;
    }
}
