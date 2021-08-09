<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ConfirmTransferInEmail
 *
 * @method string getUserClientIp()
 * @method array getDomainNames()
 * @method string getLang()
 * @method string getEmail()
 */
class ConfirmTransferInEmailRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'ConfirmTransferInEmail', 'domain');
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
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->requestParameters['Email'] = $email;
        $this->queryParameters['Email'] = $email;

        return $this;
    }
}
