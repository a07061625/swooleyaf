<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getStartOfInternetTx()
 * @method string getEcsIds()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getIzNo()
 * @method string getInternetIp()
 * @method string getImageId()
 * @method string getIoOptimized()
 * @method string getChannel()
 * @method string getVpcInstanceId()
 * @method string getNotSyncHouyi()
 * @method string getImgPc()
 * @method string getInstanceTypeId()
 * @method string getOperator()
 * @method string getVswInstanceId()
 * @method string getHostname()
 * @method string getZoneNo()
 * @method string getCores()
 * @method string getMem()
 * @method string getBizStatus()
 * @method string getPageSize()
 * @method string getAliUid()
 * @method string getExclusionEcsIds()
 * @method string getProxyId()
 * @method string getOrder()
 * @method string getSystemDeviceCategory()
 * @method string getAgentId()
 * @method string getImageType()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndOfInternetTx()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getRegionIndexId()
 * @method string getToken()
 * @method string getRegionNo()
 * @method string getEcsNetworkType()
 * @method string getInstanceIds()
 * @method string getPageNo()
 * @method string getZoneId()
 * @method string getBid()
 * @method string getIzId()
 * @method string getStatus()
 * @method string getIntranetIp()
 * @method string getOrderType()
 */
class InnerEcsQueryByParam extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartOfInternetTx($value)
    {
        $this->data['StartOfInternetTx'] = $value;
        $this->options['query']['startOfInternetTx'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsIds($value)
    {
        $this->data['EcsIds'] = $value;
        $this->options['query']['ecsIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIzNo($value)
    {
        $this->data['IzNo'] = $value;
        $this->options['query']['izNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternetIp($value)
    {
        $this->data['InternetIp'] = $value;
        $this->options['query']['internetIp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageId($value)
    {
        $this->data['ImageId'] = $value;
        $this->options['query']['imageId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIoOptimized($value)
    {
        $this->data['IoOptimized'] = $value;
        $this->options['query']['ioOptimized'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannel($value)
    {
        $this->data['Channel'] = $value;
        $this->options['query']['channel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcInstanceId($value)
    {
        $this->data['VpcInstanceId'] = $value;
        $this->options['query']['vpcInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotSyncHouyi($value)
    {
        $this->data['NotSyncHouyi'] = $value;
        $this->options['query']['notSyncHouyi'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImgPc($value)
    {
        $this->data['ImgPc'] = $value;
        $this->options['query']['imgPc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceTypeId($value)
    {
        $this->data['InstanceTypeId'] = $value;
        $this->options['query']['instanceTypeId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperator($value)
    {
        $this->data['Operator'] = $value;
        $this->options['query']['operator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVswInstanceId($value)
    {
        $this->data['VswInstanceId'] = $value;
        $this->options['query']['vswInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHostname($value)
    {
        $this->data['Hostname'] = $value;
        $this->options['query']['hostname'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withZoneNo($value)
    {
        $this->data['ZoneNo'] = $value;
        $this->options['query']['zoneNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCores($value)
    {
        $this->data['Cores'] = $value;
        $this->options['query']['cores'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMem($value)
    {
        $this->data['Mem'] = $value;
        $this->options['query']['mem'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizStatus($value)
    {
        $this->data['BizStatus'] = $value;
        $this->options['query']['bizStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['pageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAliUid($value)
    {
        $this->data['AliUid'] = $value;
        $this->options['query']['aliUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExclusionEcsIds($value)
    {
        $this->data['ExclusionEcsIds'] = $value;
        $this->options['query']['exclusionEcsIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrder($value)
    {
        $this->data['Order'] = $value;
        $this->options['query']['order'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDeviceCategory($value)
    {
        $this->data['SystemDeviceCategory'] = $value;
        $this->options['query']['systemDeviceCategory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAgentId($value)
    {
        $this->data['AgentId'] = $value;
        $this->options['query']['agentId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageType($value)
    {
        $this->data['ImageType'] = $value;
        $this->options['query']['imageType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndOfInternetTx($value)
    {
        $this->data['EndOfInternetTx'] = $value;
        $this->options['query']['endOfInternetTx'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegionIndexId($value)
    {
        $this->data['RegionIndexId'] = $value;
        $this->options['query']['regionIndexId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToken($value)
    {
        $this->data['Token'] = $value;
        $this->options['query']['token'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegionNo($value)
    {
        $this->data['RegionNo'] = $value;
        $this->options['query']['regionNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsNetworkType($value)
    {
        $this->data['EcsNetworkType'] = $value;
        $this->options['query']['ecsNetworkType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['query']['instanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNo($value)
    {
        $this->data['PageNo'] = $value;
        $this->options['query']['pageNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withZoneId($value)
    {
        $this->data['ZoneId'] = $value;
        $this->options['query']['zoneId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBid($value)
    {
        $this->data['Bid'] = $value;
        $this->options['query']['bid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIzId($value)
    {
        $this->data['IzId'] = $value;
        $this->options['query']['izId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['query']['status'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntranetIp($value)
    {
        $this->data['IntranetIp'] = $value;
        $this->options['query']['intranetIp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrderType($value)
    {
        $this->data['OrderType'] = $value;
        $this->options['query']['orderType'] = $value;

        return $this;
    }
}
