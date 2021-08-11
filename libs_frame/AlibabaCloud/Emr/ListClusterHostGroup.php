<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getStatusList()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getHostGroupName()
 * @method $this withHostGroupName($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getHostGroupId()
 * @method $this withHostGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getHostGroupType()
 * @method $this withHostGroupType($value)
 */
class ListClusterHostGroup extends Rpc
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
}
