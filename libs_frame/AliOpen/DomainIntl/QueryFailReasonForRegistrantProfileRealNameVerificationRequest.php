<?php
namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryFailReasonForRegistrantProfileRealNameVerification
 * @method string getUserClientIp()
 * @method string getRegistrantProfileID()
 * @method string getLang()
 */
class QueryFailReasonForRegistrantProfileRealNameVerificationRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'QueryFailReasonForRegistrantProfileRealNameVerification', 'domain');
    }

    /**
     * @param string $userClientIp
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $registrantProfileID
     * @return $this
     */
    public function setRegistrantProfileID($registrantProfileID)
    {
        $this->requestParameters['RegistrantProfileID'] = $registrantProfileID;
        $this->queryParameters['RegistrantProfileID'] = $registrantProfileID;

        return $this;
    }

    /**
     * @param string $lang
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
