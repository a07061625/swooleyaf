<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getReason()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getInternetIp()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getChannel()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOperator()
 * @method string getToken()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getLockType()
 * @method string getId()
 * @method string getProof()
 * @method string getProxyId()
 */
class InnerMaliceEcsUnlock extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReason($value)
    {
        $this->data['Reason'] = $value;
        $this->options['query']['reason'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternetIp($value)
    {
        $this->data['InternetIp'] = $value;
        $this->options['query']['internetIp'] = $value;

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
    public function withLockType($value)
    {
        $this->data['LockType'] = $value;
        $this->options['query']['lockType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['query']['id'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProof($value)
    {
        $this->data['Proof'] = $value;
        $this->options['query']['proof'] = $value;

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
