<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SaveTaskForSubmittingDomainRealNameVerificationByRegistrantProfileID
 *
 * @method string getInstanceId()
 * @method string getUserClientIp()
 * @method string getDomainName()
 * @method string getRegistrantProfileId()
 * @method string getLang()
 */
class SaveTaskForSubmittingDomainRealNameVerificationByRegistrantProfileIDRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'SaveTaskForSubmittingDomainRealNameVerificationByRegistrantProfileID', 'domain');
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

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
     * @param string $domainName
     *
     * @return $this
     */
    public function setDomainName($domainName)
    {
        $this->requestParameters['DomainName'] = $domainName;
        $this->queryParameters['DomainName'] = $domainName;

        return $this;
    }

    /**
     * @param string $registrantProfileId
     *
     * @return $this
     */
    public function setRegistrantProfileId($registrantProfileId)
    {
        $this->requestParameters['RegistrantProfileId'] = $registrantProfileId;
        $this->queryParameters['RegistrantProfileId'] = $registrantProfileId;

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
}
