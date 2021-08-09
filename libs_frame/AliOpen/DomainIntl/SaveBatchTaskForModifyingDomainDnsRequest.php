<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SaveBatchTaskForModifyingDomainDns
 *
 * @method string getUserClientIp()
 * @method array getDomainNames()
 * @method array getDomainNameServers()
 * @method string getLang()
 * @method string getAliyunDns()
 */
class SaveBatchTaskForModifyingDomainDnsRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'SaveBatchTaskForModifyingDomainDns', 'domain');
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
     * @return $this
     */
    public function setDomainNameServers(array $domainNameServer)
    {
        $this->requestParameters['DomainNameServers'] = $domainNameServer;
        foreach ($domainNameServer as $i => $iValue) {
            $this->queryParameters['DomainNameServer.' . ($i + 1)] = $iValue;
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
     * @param string $aliyunDns
     *
     * @return $this
     */
    public function setAliyunDns($aliyunDns)
    {
        $this->requestParameters['AliyunDns'] = $aliyunDns;
        $this->queryParameters['AliyunDns'] = $aliyunDns;

        return $this;
    }
}
