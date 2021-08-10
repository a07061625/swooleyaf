<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getCallingNumber()
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getCalledNumber()
 * @method string getCustomerInfo()
 */
class SendOutboundCommand extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallingNumber($value)
    {
        $this->data['CallingNumber'] = $value;
        $this->options['form_params']['CallingNumber'] = $value;

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
    public function withCalledNumber($value)
    {
        $this->data['CalledNumber'] = $value;
        $this->options['form_params']['CalledNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCustomerInfo($value)
    {
        $this->data['CustomerInfo'] = $value;
        $this->options['form_params']['CustomerInfo'] = $value;

        return $this;
    }
}
