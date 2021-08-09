<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SubmitEmailVerification
 *
 * @method string getSendIfExist()
 * @method string getUserClientIp()
 * @method string getLang()
 * @method string getEmail()
 */
class SubmitEmailVerificationRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'SubmitEmailVerification', 'domain');
    }

    /**
     * @param string $sendIfExist
     *
     * @return $this
     */
    public function setSendIfExist($sendIfExist)
    {
        $this->requestParameters['SendIfExist'] = $sendIfExist;
        $this->queryParameters['SendIfExist'] = $sendIfExist;

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
