<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getQueueNumber()
 * @method $this withQueueNumber($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getSecurityGroupId()
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getNetworkInterfaceName()
 * @method $this withNetworkInterfaceName($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getNetworkInterfaceId()
 * @method $this withNetworkInterfaceId($value)
 */
class ModifyNetworkInterfaceAttribute extends Rpc
{
    /**
     * @return $this
     */
    public function withSecurityGroupId(array $securityGroupId)
    {
        $this->data['SecurityGroupId'] = $securityGroupId;
        foreach ($securityGroupId as $i => $iValue) {
            $this->options['query']['SecurityGroupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
