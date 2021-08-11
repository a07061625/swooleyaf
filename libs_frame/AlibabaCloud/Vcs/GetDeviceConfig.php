<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getDeviceTimeStamp()
 * @method string getDeviceSn()
 */
class GetDeviceConfig extends Rpc
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
}
