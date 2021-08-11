<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getToVSwitchId()
 * @method $this withToVSwitchId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getChannel()
 * @method string getOperator()
 * @method string getAliUid()
 * @method $this withAliUid($value)
 * @method string getProxyId()
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method array getPrivateIps()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getKeepPublicIp()
 * @method $this withKeepPublicIp($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getToken()
 * @method string getNewOwnerId()
 * @method $this withNewOwnerId($value)
 * @method string getToSecurityGroupId()
 * @method $this withToSecurityGroupId($value)
 * @method array getInstanceIds()
 * @method string getAppKey()
 * @method string getBid()
 * @method $this withBid($value)
 * @method string getToVSwitchAliUid()
 * @method $this withToVSwitchAliUid($value)
 */
class ResourceOwnershipTransfer extends Rpc
{
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
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withPrivateIps(array $privateIps)
    {
        $this->data['PrivateIps'] = $privateIps;
        foreach ($privateIps as $i => $iValue) {
            $this->options['query']['PrivateIps.' . ($i + 1)] = $iValue;
        }

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
     * @return $this
     */
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppKey($value)
    {
        $this->data['AppKey'] = $value;
        $this->options['query']['appKey'] = $value;

        return $this;
    }
}
