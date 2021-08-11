<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getCountry()
 * @method $this withCountry($value)
 * @method string getIdentityCredentialType()
 * @method $this withIdentityCredentialType($value)
 * @method string getAddress()
 * @method $this withAddress($value)
 * @method string getTelArea()
 * @method $this withTelArea($value)
 * @method string getCity()
 * @method $this withCity($value)
 * @method string getRegistrantType()
 * @method $this withRegistrantType($value)
 * @method array getDomainName()
 * @method string getIdentityCredential()
 * @method string getTelephone()
 * @method $this withTelephone($value)
 * @method string getTransferOutProhibited()
 * @method $this withTransferOutProhibited($value)
 * @method string getRegistrantOrganization()
 * @method $this withRegistrantOrganization($value)
 * @method string getTelExt()
 * @method $this withTelExt($value)
 * @method string getProvince()
 * @method $this withProvince($value)
 * @method string getPostalCode()
 * @method $this withPostalCode($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getIdentityCredentialNo()
 * @method $this withIdentityCredentialNo($value)
 * @method string getEmail()
 * @method $this withEmail($value)
 * @method string getRegistrantName()
 * @method $this withRegistrantName($value)
 */
class SaveTaskForUpdatingRegistrantInfoByIdentityCredential extends Rpc
{
    /**
     * @return $this
     */
    public function withDomainName(array $domainName)
    {
        $this->data['DomainName'] = $domainName;
        foreach ($domainName as $i => $iValue) {
            $this->options['query']['DomainName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIdentityCredential($value)
    {
        $this->data['IdentityCredential'] = $value;
        $this->options['form_params']['IdentityCredential'] = $value;

        return $this;
    }
}
