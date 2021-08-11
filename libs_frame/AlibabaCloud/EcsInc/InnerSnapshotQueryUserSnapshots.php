<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getEcsIds()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSnapshotNickName()
 * @method string getAliUids()
 * @method string getSnapshotIds()
 * @method string getChannel()
 * @method string getDeviceNo()
 * @method string getOperator()
 * @method string getDeviceType()
 * @method string getGmtCreatedBegin()
 * @method string getEcsSnapshotStatus()
 * @method string getCreateFinished()
 * @method string getFuzzySnapshotName()
 * @method string getPageSize()
 * @method string getDiskId()
 * @method string getEcsSnapshotTypes()
 * @method string getQuoteType()
 * @method string getGmtCreatedEnd()
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getExcludeSnapshotIds()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDiskType()
 * @method string getRegionIndexId()
 * @method string getToken()
 * @method string getRegionNo()
 * @method string getPageNo()
 * @method string getSnapshotSizeLowLimit()
 * @method string getIds()
 * @method string getSnapshotSizeLimit()
 * @method string getIsSyncHouyi()
 * @method string getBid()
 * @method string getSnapshotNos()
 */
class InnerSnapshotQueryUserSnapshots extends Rpc
{
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
    public function withSnapshotNickName($value)
    {
        $this->data['SnapshotNickName'] = $value;
        $this->options['query']['snapshotNickName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAliUids($value)
    {
        $this->data['AliUids'] = $value;
        $this->options['query']['aliUids'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSnapshotIds($value)
    {
        $this->data['SnapshotIds'] = $value;
        $this->options['query']['snapshotIds'] = $value;

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
    public function withDeviceNo($value)
    {
        $this->data['DeviceNo'] = $value;
        $this->options['query']['deviceNo'] = $value;

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
    public function withDeviceType($value)
    {
        $this->data['DeviceType'] = $value;
        $this->options['query']['deviceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGmtCreatedBegin($value)
    {
        $this->data['GmtCreatedBegin'] = $value;
        $this->options['query']['gmtCreatedBegin'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsSnapshotStatus($value)
    {
        $this->data['EcsSnapshotStatus'] = $value;
        $this->options['query']['ecsSnapshotStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreateFinished($value)
    {
        $this->data['CreateFinished'] = $value;
        $this->options['query']['createFinished'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzySnapshotName($value)
    {
        $this->data['FuzzySnapshotName'] = $value;
        $this->options['query']['fuzzySnapshotName'] = $value;

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
    public function withDiskId($value)
    {
        $this->data['DiskId'] = $value;
        $this->options['query']['diskId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsSnapshotTypes($value)
    {
        $this->data['EcsSnapshotTypes'] = $value;
        $this->options['query']['ecsSnapshotTypes'] = $value;

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
    public function withGmtCreatedEnd($value)
    {
        $this->data['GmtCreatedEnd'] = $value;
        $this->options['query']['gmtCreatedEnd'] = $value;

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
    public function withExcludeSnapshotIds($value)
    {
        $this->data['ExcludeSnapshotIds'] = $value;
        $this->options['query']['excludeSnapshotIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDiskType($value)
    {
        $this->data['DiskType'] = $value;
        $this->options['query']['diskType'] = $value;

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
    public function withSnapshotSizeLowLimit($value)
    {
        $this->data['SnapshotSizeLowLimit'] = $value;
        $this->options['query']['snapshotSizeLowLimit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIds($value)
    {
        $this->data['Ids'] = $value;
        $this->options['query']['ids'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSnapshotSizeLimit($value)
    {
        $this->data['SnapshotSizeLimit'] = $value;
        $this->options['query']['snapshotSizeLimit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsSyncHouyi($value)
    {
        $this->data['IsSyncHouyi'] = $value;
        $this->options['query']['isSyncHouyi'] = $value;

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
    public function withSnapshotNos($value)
    {
        $this->data['SnapshotNos'] = $value;
        $this->options['query']['snapshotNos'] = $value;

        return $this;
    }
}
