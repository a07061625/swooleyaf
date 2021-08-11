<?php

namespace AlibabaCloud\MoPen;

/**
 * @method string getOrderKey()
 * @method string getDeviceName()
 */
class MoPenBindIsv extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrderKey($value)
    {
        $this->data['OrderKey'] = $value;
        $this->options['form_params']['OrderKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceName($value)
    {
        $this->data['DeviceName'] = $value;
        $this->options['form_params']['DeviceName'] = $value;

        return $this;
    }
}
