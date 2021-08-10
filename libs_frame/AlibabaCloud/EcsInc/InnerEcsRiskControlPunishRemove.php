<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getReason()
 * @method string getBussinessCode()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getCoordinate()
 * @method string getSignatureCode()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getChannel()
 * @method string getPunishResult()
 * @method string getActionCode()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOperator()
 * @method string getToken()
 * @method string getAsync()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAliUid()
 * @method string getBid()
 * @method string getProxyId()
 */
class InnerEcsRiskControlPunishRemove extends Rpc
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
    public function withBussinessCode($value)
    {
        $this->data['BussinessCode'] = $value;
        $this->options['query']['bussinessCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCoordinate($value)
    {
        $this->data['Coordinate'] = $value;
        $this->options['query']['coordinate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSignatureCode($value)
    {
        $this->data['SignatureCode'] = $value;
        $this->options['query']['signatureCode'] = $value;

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
    public function withPunishResult($value)
    {
        $this->data['PunishResult'] = $value;
        $this->options['query']['punishResult'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withActionCode($value)
    {
        $this->data['ActionCode'] = $value;
        $this->options['query']['actionCode'] = $value;

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
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }
}
