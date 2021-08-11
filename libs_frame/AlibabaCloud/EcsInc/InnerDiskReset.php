<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getEcsInstanceId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getChannel()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDiskType()
 * @method string getOperator()
 * @method string getToken()
 * @method string getAsync()
 * @method string getPasswd()
 * @method string getInstanceIds()
 * @method string getUseImagePasswd()
 * @method string getKeepDiskSize()
 * @method string getProxyId()
 */
class InnerDiskReset extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsInstanceId($value)
    {
        $this->data['EcsInstanceId'] = $value;
        $this->options['query']['ecsInstanceId'] = $value;

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
    public function withDiskType($value)
    {
        $this->data['DiskType'] = $value;
        $this->options['query']['diskType'] = $value;

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
    public function withPasswd($value)
    {
        $this->data['Passwd'] = $value;
        $this->options['query']['passwd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['query']['instanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUseImagePasswd($value)
    {
        $this->data['UseImagePasswd'] = $value;
        $this->options['query']['useImagePasswd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKeepDiskSize($value)
    {
        $this->data['KeepDiskSize'] = $value;
        $this->options['query']['keepDiskSize'] = $value;

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
}
