<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getQueueNumber()
 * @method $this withQueueNumber($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSecondaryPrivateIpAddressCount()
 * @method $this withSecondaryPrivateIpAddressCount($value)
 * @method string getBusinessType()
 * @method $this withBusinessType($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method array getTag()
 * @method string getNetworkInterfaceName()
 * @method $this withNetworkInterfaceName($value)
 * @method string getVisible()
 * @method $this withVisible($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getIpv6AddressCount()
 * @method $this withIpv6AddressCount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getQueuePairNumber()
 * @method $this withQueuePairNumber($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getSecurityGroupIds()
 * @method string getNetworkInterfaceTrafficMode()
 * @method $this withNetworkInterfaceTrafficMode($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method array getPrivateIpAddress()
 * @method string getPrimaryIpAddress()
 * @method $this withPrimaryIpAddress($value)
 * @method array getIpv6Address()
 */
class CreateNetworkInterface extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSecurityGroupIds(array $securityGroupIds)
    {
        $this->data['SecurityGroupIds'] = $securityGroupIds;
        foreach ($securityGroupIds as $i => $iValue) {
            $this->options['query']['SecurityGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

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

    /**
     * @return $this
     */
    public function withIpv6Address(array $ipv6Address)
    {
        $this->data['Ipv6Address'] = $ipv6Address;
        foreach ($ipv6Address as $i => $iValue) {
            $this->options['query']['Ipv6Address.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
