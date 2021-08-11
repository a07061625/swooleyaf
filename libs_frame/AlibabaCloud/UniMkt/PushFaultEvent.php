<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getFaultComment()
 * @method string getTime()
 * @method string getType()
 * @method string getDeviceSn()
 * @method string getChannelId()
 * @method string getFaultType()
 */
class PushFaultEvent extends Rpc
{
    /** @var string */
    public $scheme = 'https';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFaultComment($value)
    {
        $this->data['FaultComment'] = $value;
        $this->options['form_params']['FaultComment'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTime($value)
    {
        $this->data['Time'] = $value;
        $this->options['form_params']['Time'] = $value;

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
    public function withDeviceSn($value)
    {
        $this->data['DeviceSn'] = $value;
        $this->options['form_params']['DeviceSn'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFaultType($value)
    {
        $this->data['FaultType'] = $value;
        $this->options['form_params']['FaultType'] = $value;

        return $this;
    }
}
