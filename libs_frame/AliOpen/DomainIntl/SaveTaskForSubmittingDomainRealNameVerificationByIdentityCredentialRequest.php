<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SaveTaskForSubmittingDomainRealNameVerificationByIdentityCredential
 *
 * @method string getIdentityCredentialType()
 * @method string getUserClientIp()
 * @method string getIdentityCredential()
 * @method array getDomainNames()
 * @method string getLang()
 * @method string getIdentityCredentialNo()
 */
class SaveTaskForSubmittingDomainRealNameVerificationByIdentityCredentialRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'SaveTaskForSubmittingDomainRealNameVerificationByIdentityCredential', 'domain');
    }

    /**
     * @param string $identityCredentialType
     *
     * @return $this
     */
    public function setIdentityCredentialType($identityCredentialType)
    {
        $this->requestParameters['IdentityCredentialType'] = $identityCredentialType;
        $this->queryParameters['IdentityCredentialType'] = $identityCredentialType;

        return $this;
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $identityCredential
     *
     * @return $this
     */
    public function setIdentityCredential($identityCredential)
    {
        $this->requestParameters['IdentityCredential'] = $identityCredential;
        $this->queryParameters['IdentityCredential'] = $identityCredential;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDomainNames(array $domainName)
    {
        $this->requestParameters['DomainNames'] = $domainName;
        foreach ($domainName as $i => $iValue) {
            $this->queryParameters['DomainName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }

    /**
     * @param string $identityCredentialNo
     *
     * @return $this
     */
    public function setIdentityCredentialNo($identityCredentialNo)
    {
        $this->requestParameters['IdentityCredentialNo'] = $identityCredentialNo;
        $this->queryParameters['IdentityCredentialNo'] = $identityCredentialNo;

        return $this;
    }
}
