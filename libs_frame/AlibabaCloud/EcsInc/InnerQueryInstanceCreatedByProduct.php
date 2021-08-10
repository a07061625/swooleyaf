<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getPrivateIpAddresses()
 * @method array getAliUids()
 * @method array getInstanceTypes()
 * @method string getChannel()
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getOperator()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getPublicIpAddresses()
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getToken()
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 */
class InnerQueryInstanceCreatedByProduct extends Rpc
{
    /**
     * @return $this
     */
    public function withPrivateIpAddresses(array $privateIpAddresses)
    {
        $this->data['PrivateIpAddresses'] = $privateIpAddresses;
        foreach ($privateIpAddresses as $i => $iValue) {
            $this->options['query']['PrivateIpAddresses.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAliUids(array $aliUids)
    {
        $this->data['AliUids'] = $aliUids;
        foreach ($aliUids as $i => $iValue) {
            $this->options['query']['AliUids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceTypes(array $instanceTypes)
    {
        $this->data['InstanceTypes'] = $instanceTypes;
        foreach ($instanceTypes as $i => $iValue) {
            $this->options['query']['InstanceTypes.' . ($i + 1)] = $iValue;
        }

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
     * @return $this
     */
    public function withPublicIpAddresses(array $publicIpAddresses)
    {
        $this->data['PublicIpAddresses'] = $publicIpAddresses;
        foreach ($publicIpAddresses as $i => $iValue) {
            $this->options['query']['PublicIpAddresses.' . ($i + 1)] = $iValue;
        }

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
    public function withToken($value)
    {
        $this->data['Token'] = $value;
        $this->options['query']['token'] = $value;

        return $this;
    }
}
