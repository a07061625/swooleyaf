<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getAutoProvisioningGroupStatus()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getAutoProvisioningGroupId()
 * @method string getAutoProvisioningGroupName()
 * @method $this withAutoProvisioningGroupName($value)
 */
class DescribeAutoProvisioningGroups extends Rpc
{
    /**
     * @return $this
     */
    public function withAutoProvisioningGroupStatus(array $autoProvisioningGroupStatus)
    {
        $this->data['AutoProvisioningGroupStatus'] = $autoProvisioningGroupStatus;
        foreach ($autoProvisioningGroupStatus as $i => $iValue) {
            $this->options['query']['AutoProvisioningGroupStatus.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAutoProvisioningGroupId(array $autoProvisioningGroupId)
    {
        $this->data['AutoProvisioningGroupId'] = $autoProvisioningGroupId;
        foreach ($autoProvisioningGroupId as $i => $iValue) {
            $this->options['query']['AutoProvisioningGroupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
