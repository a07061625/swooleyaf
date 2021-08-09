<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of FuzzyMatchDomainSensitiveWord
 *
 * @method string getUserClientIp()
 * @method string getKeyword()
 * @method string getLang()
 */
class FuzzyMatchDomainSensitiveWordRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'FuzzyMatchDomainSensitiveWord', 'domain');
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
     * @param string $keyword
     *
     * @return $this
     */
    public function setKeyword($keyword)
    {
        $this->requestParameters['Keyword'] = $keyword;
        $this->queryParameters['Keyword'] = $keyword;

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
