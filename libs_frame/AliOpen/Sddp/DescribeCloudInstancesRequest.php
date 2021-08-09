<?php

namespace AliOpen\Sddp;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCloudInstances
 *
 * @method string getSourceIp()
 * @method string getLang()
 * @method string getResourceType()
 * @method string getServiceRegionId()
 */
class DescribeCloudInstancesRequest extends RpcAcsRequest
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
        parent::__construct('Sddp', '2019-01-03', 'DescribeCloudInstances', 'sddp');
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

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
     * @param string $resourceType
     *
     * @return $this
     */
    public function setResourceType($resourceType)
    {
        $this->requestParameters['ResourceType'] = $resourceType;
        $this->queryParameters['ResourceType'] = $resourceType;

        return $this;
    }

    /**
     * @param string $serviceRegionId
     *
     * @return $this
     */
    public function setServiceRegionId($serviceRegionId)
    {
        $this->requestParameters['ServiceRegionId'] = $serviceRegionId;
        $this->queryParameters['ServiceRegionId'] = $serviceRegionId;

        return $this;
    }
}
