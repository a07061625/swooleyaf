<?php

namespace AliOpen\DCdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDcdnDomainCertificateInfo
 *
 * @method string getDomainName()
 * @method string getOwnerId()
 */
class DescribeDcdnDomainCertificateInfoRequest extends RpcAcsRequest
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
        parent::__construct('dcdn', '2018-01-15', 'DescribeDcdnDomainCertificateInfo');
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
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
