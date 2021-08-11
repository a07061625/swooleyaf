<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getTargetAccountName()
 * @method string getCallId()
 * @method string getJobId()
 * @method string getConnectionId()
 * @method string getHoldConnectionId()
 * @method string getType()
 * @method string getIsSingleTransfer()
 */
class TransferCallToAgent extends Rpc
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
    public function withTargetAccountName($value)
    {
        $this->data['TargetAccountName'] = $value;
        $this->options['form_params']['TargetAccountName'] = $value;

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
}
