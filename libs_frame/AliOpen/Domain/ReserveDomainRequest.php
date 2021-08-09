<?php

namespace AliOpen\Domain;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ReserveDomain
 *
 * @method array getChannelss()
 * @method string getDomainName()
 */
class ReserveDomainRequest extends RpcAcsRequest
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
        parent::__construct('Domain', '2018-02-08', 'ReserveDomain');
    }

    /**
     * @return $this
     */
    public function setChannelss(array $channels)
    {
        $this->requestParameters['Channelss'] = $channels;
        foreach ($channels as $i => $iValue) {
            $this->queryParameters['Channels.' . ($i + 1)] = $iValue;
        }

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
}
