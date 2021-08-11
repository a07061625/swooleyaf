<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getDeviceTimeStamp()
 * @method string getDeviceSn()
 * @method string getDeviceId()
 * @method string getServerId()
 */
class RegisterDevice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceTimeStamp($value)
    {
        $this->data['DeviceTimeStamp'] = $value;
        $this->options['form_params']['DeviceTimeStamp'] = $value;

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
    public function withDeviceId($value)
    {
        $this->data['DeviceId'] = $value;
        $this->options['form_params']['DeviceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServerId($value)
    {
        $this->data['ServerId'] = $value;
        $this->options['form_params']['ServerId'] = $value;

        return $this;
    }
}
