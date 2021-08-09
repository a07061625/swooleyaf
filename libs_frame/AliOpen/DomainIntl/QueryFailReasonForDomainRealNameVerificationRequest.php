<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryFailReasonForDomainRealNameVerification
 *
 * @method string getRealNameVerificationAction()
 * @method string getUserClientIp()
 * @method string getDomainName()
 * @method string getLang()
 */
class QueryFailReasonForDomainRealNameVerificationRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'QueryFailReasonForDomainRealNameVerification', 'domain');
    }

    /**
     * @param string $realNameVerificationAction
     *
     * @return $this
     */
    public function setRealNameVerificationAction($realNameVerificationAction)
    {
        $this->requestParameters['RealNameVerificationAction'] = $realNameVerificationAction;
        $this->queryParameters['RealNameVerificationAction'] = $realNameVerificationAction;

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
