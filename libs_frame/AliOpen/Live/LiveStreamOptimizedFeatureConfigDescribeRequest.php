<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeLiveStreamOptimizedFeatureConfig
 * @method string getConfigName()
 * @method string getDomainName()
 * @method string getOwnerId()
 */
class LiveStreamOptimizedFeatureConfigDescribeRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'DescribeLiveStreamOptimizedFeatureConfig', 'live');
    }

    /**
     * @param string $configName
     * @return $this
     */
    public function setConfigName($configName)
    {
        $this->requestParameters['ConfigName'] = $configName;
        $this->queryParameters['ConfigName'] = $configName;

        return $this;
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
