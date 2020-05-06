<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDomainRealtimeLogDelivery
 * @method string getOwnerId()
 * @method string getDomain()
 */
class DomainRealtimeLogDeliveryDescribeRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Cdn', '2018-05-10', 'DescribeDomainRealtimeLogDelivery');
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

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->requestParameters['Domain'] = $domain;
        $this->queryParameters['Domain'] = $domain;

        return $this;
    }
}
