<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getDeviceCode()
 * @method string getV()
 * @method string getChannelId()
 */
class CheckReceivingDetail extends Rpc
{
    /** @var string */
    public $scheme = 'https';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceCode($value)
    {
        $this->data['DeviceCode'] = $value;
        $this->options['form_params']['DeviceCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withV($value)
    {
        $this->data['V'] = $value;
        $this->options['form_params']['V'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelId($value)
    {
        $this->data['ChannelId'] = $value;
        $this->options['form_params']['ChannelId'] = $value;

        return $this;
    }
}
