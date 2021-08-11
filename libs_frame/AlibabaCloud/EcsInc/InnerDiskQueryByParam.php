<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getFuzzyDiskName()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getIzNo()
 * @method string getPrePayEcsInstanceIds()
 * @method string getAutoSnapshotPolicyId()
 * @method string getChannel()
 * @method string getOperator()
 * @method string getExcludeStatus()
 * @method string getDiskName()
 * @method string getDeleteAutoSnapshot()
 * @method string getDiskCategory()
 * @method string getPageSize()
 * @method string getSnapshotNo()
 * @method string getAliUid()
 * @method string getDeleteWithInstance()
 * @method string getProxyId()
 * @method string getPostPayEcsInstanceIds()
 * @method string getEcsInstanceId()
 * @method string getEnableAutoSnapshot()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getActive()
 * @method string getImageNo()
 * @method string getCreateTimeFrom()
 * @method string getEnableAutomatedSnapshotPolicy()
 * @method string getPortable()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDiskType()
 * @method string getToken()
 * @method string getTags()
 * @method string getAsync()
 * @method string getInstanceIds()
 * @method string getPageNo()
 * @method string getCreateTimeTo()
 * @method string getBid()
 * @method string getStatus()
 */
class InnerDiskQueryByParam extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyDiskName($value)
    {
        $this->data['FuzzyDiskName'] = $value;
        $this->options['query']['fuzzyDiskName'] = $value;

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
    public function withPrePayEcsInstanceIds($value)
    {
        $this->data['PrePayEcsInstanceIds'] = $value;
        $this->options['query']['prePayEcsInstanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoSnapshotPolicyId($value)
    {
        $this->data['AutoSnapshotPolicyId'] = $value;
        $this->options['query']['autoSnapshotPolicyId'] = $value;

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
    public function withExcludeStatus($value)
    {
        $this->data['ExcludeStatus'] = $value;
        $this->options['query']['excludeStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDiskName($value)
    {
        $this->data['DiskName'] = $value;
        $this->options['query']['diskName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeleteAutoSnapshot($value)
    {
        $this->data['DeleteAutoSnapshot'] = $value;
        $this->options['query']['deleteAutoSnapshot'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDiskCategory($value)
    {
        $this->data['DiskCategory'] = $value;
        $this->options['query']['diskCategory'] = $value;

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
    public function withSnapshotNo($value)
    {
        $this->data['SnapshotNo'] = $value;
        $this->options['query']['snapshotNo'] = $value;

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
    public function withDeleteWithInstance($value)
    {
        $this->data['DeleteWithInstance'] = $value;
        $this->options['query']['deleteWithInstance'] = $value;

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
    public function withPostPayEcsInstanceIds($value)
    {
        $this->data['PostPayEcsInstanceIds'] = $value;
        $this->options['query']['postPayEcsInstanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsInstanceId($value)
    {
        $this->data['EcsInstanceId'] = $value;
        $this->options['query']['ecsInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableAutoSnapshot($value)
    {
        $this->data['EnableAutoSnapshot'] = $value;
        $this->options['query']['enableAutoSnapshot'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withActive($value)
    {
        $this->data['Active'] = $value;
        $this->options['query']['active'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageNo($value)
    {
        $this->data['ImageNo'] = $value;
        $this->options['query']['imageNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreateTimeFrom($value)
    {
        $this->data['CreateTimeFrom'] = $value;
        $this->options['query']['createTimeFrom'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableAutomatedSnapshotPolicy($value)
    {
        $this->data['EnableAutomatedSnapshotPolicy'] = $value;
        $this->options['query']['enableAutomatedSnapshotPolicy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPortable($value)
    {
        $this->data['Portable'] = $value;
        $this->options['query']['portable'] = $value;

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
    public function withCreateTimeTo($value)
    {
        $this->data['CreateTimeTo'] = $value;
        $this->options['query']['createTimeTo'] = $value;

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
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['query']['status'] = $value;

        return $this;
    }
}
