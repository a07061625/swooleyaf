<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getNetworkInterfacePermissionId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getNetworkInterfaceId()
 * @method $this withNetworkInterfaceId($value)
 */
class DescribeNetworkInterfacePermissions extends Rpc
{
    /**
     * @return $this
     */
    public function withNetworkInterfacePermissionId(array $networkInterfacePermissionId)
    {
        $this->data['NetworkInterfacePermissionId'] = $networkInterfacePermissionId;
        foreach ($networkInterfacePermissionId as $i => $iValue) {
            $this->options['query']['NetworkInterfacePermissionId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
