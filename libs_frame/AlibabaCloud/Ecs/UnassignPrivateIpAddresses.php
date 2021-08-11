<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getPrivateIpAddress()
 * @method string getNetworkInterfaceId()
 * @method $this withNetworkInterfaceId($value)
 */
class UnassignPrivateIpAddresses extends Rpc
{
    /**
     * @return $this
     */
    public function withPrivateIpAddress(array $privateIpAddress)
    {
        $this->data['PrivateIpAddress'] = $privateIpAddress;
        foreach ($privateIpAddress as $i => $iValue) {
            $this->options['query']['PrivateIpAddress.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
