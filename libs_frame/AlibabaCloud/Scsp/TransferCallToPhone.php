<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getCaller()
 * @method string getCallee()
 * @method string getCallId()
 * @method string getJobId()
 * @method string getConnectionId()
 * @method string getHoldConnectionId()
 * @method string getType()
 * @method string getIsSingleTransfer()
 * @method string getCallerPhone()
 * @method string getCalleePhone()
 */
class TransferCallToPhone extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountName($value)
    {
        $this->data['AccountName'] = $value;
        $this->options['form_params']['AccountName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCaller($value)
    {
        $this->data['Caller'] = $value;
        $this->options['form_params']['Caller'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallee($value)
    {
        $this->data['Callee'] = $value;
        $this->options['form_params']['Callee'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallId($value)
    {
        $this->data['CallId'] = $value;
        $this->options['form_params']['CallId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobId($value)
    {
        $this->data['JobId'] = $value;
        $this->options['form_params']['JobId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConnectionId($value)
    {
        $this->data['ConnectionId'] = $value;
        $this->options['form_params']['ConnectionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHoldConnectionId($value)
    {
        $this->data['HoldConnectionId'] = $value;
        $this->options['form_params']['HoldConnectionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['form_params']['Type'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsSingleTransfer($value)
    {
        $this->data['IsSingleTransfer'] = $value;
        $this->options['form_params']['IsSingleTransfer'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallerPhone($value)
    {
        $this->data['CallerPhone'] = $value;
        $this->options['form_params']['callerPhone'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCalleePhone($value)
    {
        $this->data['CalleePhone'] = $value;
        $this->options['form_params']['calleePhone'] = $value;

        return $this;
    }
}
