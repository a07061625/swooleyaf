<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getCaller()
 * @method string getCallee()
 */
class StartCall extends Rpc
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
}
