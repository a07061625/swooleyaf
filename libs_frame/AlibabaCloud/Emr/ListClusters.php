<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getStatusList()
 * @method string getIsDesc()
 * @method $this withIsDesc($value)
 * @method string getDepositType()
 * @method $this withDepositType($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getMachineType()
 * @method $this withMachineType($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getTag()
 * @method string getCreateType()
 * @method $this withCreateType($value)
 * @method array getExpiredTagList()
 * @method string getDefaultStatus()
 * @method $this withDefaultStatus($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getClusterTypeList()
 */
class ListClusters extends Rpc
{
    /**
     * @return $this
     */
    public function withStatusList(array $statusList)
    {
        $this->data['StatusList'] = $statusList;
        foreach ($statusList as $i => $iValue) {
            $this->options['query']['StatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withExpiredTagList(array $expiredTagList)
    {
        $this->data['ExpiredTagList'] = $expiredTagList;
        foreach ($expiredTagList as $i => $iValue) {
            $this->options['query']['ExpiredTagList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withClusterTypeList(array $clusterTypeList)
    {
        $this->data['ClusterTypeList'] = $clusterTypeList;
        foreach ($clusterTypeList as $i => $iValue) {
            $this->options['query']['ClusterTypeList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
