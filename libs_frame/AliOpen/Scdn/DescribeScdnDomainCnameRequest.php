<?php

namespace AliOpen\Scdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeScdnDomainCname
 * @method string getDomainName()
 * @method string getOwnerId()
 */
class DescribeScdnDomainCnameRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('scdn', '2017-11-15', 'DescribeScdnDomainCname');
    }

    /**
     * @param string $domainName
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
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
