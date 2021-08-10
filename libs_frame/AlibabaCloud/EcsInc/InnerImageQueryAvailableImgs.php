<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSnapshotId()
 * @method string getIoOptimized()
 * @method string getChannel()
 * @method string getIsAll()
 * @method string getFuzzyImageName()
 * @method string getOperator()
 * @method string getImageOwnerAlias()
 * @method string getImageName()
 * @method string getPageSize()
 * @method string getInstanceType()
 * @method string getAliUid()
 * @method string getQuoteType()
 * @method string getCreateEndTime()
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getUserCountryType()
 * @method string getOsType()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCreateStartTime()
 * @method string getToken()
 * @method string getTags()
 * @method string getRegionNos()
 * @method string getAsync()
 * @method string getPageNo()
 * @method string getOsBit()
 * @method string getBid()
 * @method string getImageIds()
 * @method string getStatus()
 */
class InnerImageQueryAvailableImgs extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSnapshotId($value)
    {
        $this->data['SnapshotId'] = $value;
        $this->options['query']['snapshotId'] = $value;

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
    public function withIsAll($value)
    {
        $this->data['IsAll'] = $value;
        $this->options['query']['isAll'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyImageName($value)
    {
        $this->data['FuzzyImageName'] = $value;
        $this->options['query']['fuzzyImageName'] = $value;

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
    public function withImageOwnerAlias($value)
    {
        $this->data['ImageOwnerAlias'] = $value;
        $this->options['query']['imageOwnerAlias'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageName($value)
    {
        $this->data['ImageName'] = $value;
        $this->options['query']['imageName'] = $value;

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
    public function withInstanceType($value)
    {
        $this->data['InstanceType'] = $value;
        $this->options['query']['instanceType'] = $value;

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
    public function withQuoteType($value)
    {
        $this->data['QuoteType'] = $value;
        $this->options['query']['quoteType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreateEndTime($value)
    {
        $this->data['CreateEndTime'] = $value;
        $this->options['query']['createEndTime'] = $value;

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
    public function withUserCountryType($value)
    {
        $this->data['UserCountryType'] = $value;
        $this->options['query']['userCountryType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOsType($value)
    {
        $this->data['OsType'] = $value;
        $this->options['query']['osType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreateStartTime($value)
    {
        $this->data['CreateStartTime'] = $value;
        $this->options['query']['createStartTime'] = $value;

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
    public function withTags($value)
    {
        $this->data['Tags'] = $value;
        $this->options['query']['tags'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegionNos($value)
    {
        $this->data['RegionNos'] = $value;
        $this->options['query']['regionNos'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAsync($value)
    {
        $this->data['Async'] = $value;
        $this->options['query']['async'] = $value;

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
    public function withOsBit($value)
    {
        $this->data['OsBit'] = $value;
        $this->options['query']['osBit'] = $value;

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
    public function withImageIds($value)
    {
        $this->data['ImageIds'] = $value;
        $this->options['query']['imageIds'] = $value;

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
}
