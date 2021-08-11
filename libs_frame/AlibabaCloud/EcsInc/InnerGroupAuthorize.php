<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getChannel()
 * @method string getNic()
 * @method string getVpcInstanceId()
 * @method string getOperator()
 * @method string getAliUid()
 * @method string getProxyId()
 * @method string getPolicy()
 * @method string getSourceGroupNo()
 * @method string getPortRange()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getLevel()
 * @method string getIpProtocol()
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getSourceCidrIp()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDestCidrIp()
 * @method string getToken()
 * @method string getSourceGroupOwnerAliUid()
 * @method string getAsync()
 * @method string getSourceGroupId()
 * @method string getBid()
 * @method string getGroupNo()
 */
class InnerGroupAuthorize extends Rpc
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
    public function withNic($value)
    {
        $this->data['Nic'] = $value;
        $this->options['query']['nic'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcInstanceId($value)
    {
        $this->data['VpcInstanceId'] = $value;
        $this->options['query']['vpcInstanceId'] = $value;

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
    public function withPolicy($value)
    {
        $this->data['Policy'] = $value;
        $this->options['query']['policy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceGroupNo($value)
    {
        $this->data['SourceGroupNo'] = $value;
        $this->options['query']['sourceGroupNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPortRange($value)
    {
        $this->data['PortRange'] = $value;
        $this->options['query']['portRange'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLevel($value)
    {
        $this->data['Level'] = $value;
        $this->options['query']['level'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIpProtocol($value)
    {
        $this->data['IpProtocol'] = $value;
        $this->options['query']['ipProtocol'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceCidrIp($value)
    {
        $this->data['SourceCidrIp'] = $value;
        $this->options['query']['sourceCidrIp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDestCidrIp($value)
    {
        $this->data['DestCidrIp'] = $value;
        $this->options['query']['destCidrIp'] = $value;

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
    public function withSourceGroupOwnerAliUid($value)
    {
        $this->data['SourceGroupOwnerAliUid'] = $value;
        $this->options['query']['sourceGroupOwnerAliUid'] = $value;

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
    public function withSourceGroupId($value)
    {
        $this->data['SourceGroupId'] = $value;
        $this->options['query']['sourceGroupId'] = $value;

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
    public function withGroupNo($value)
    {
        $this->data['GroupNo'] = $value;
        $this->options['query']['groupNo'] = $value;

        return $this;
    }
}
