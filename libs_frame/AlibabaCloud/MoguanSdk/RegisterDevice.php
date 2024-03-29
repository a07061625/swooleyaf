<?php

namespace AlibabaCloud\MoguanSdk;

/**
 * @method string getUserDeviceId()
 * @method string getExtend()
 * @method string getSdkCode()
 * @method string getAppKey()
 * @method string getDeviceId()
 */
class RegisterDevice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserDeviceId($value)
    {
        $this->data['UserDeviceId'] = $value;
        $this->options['form_params']['UserDeviceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtend($value)
    {
        $this->data['Extend'] = $value;
        $this->options['form_params']['Extend'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSdkCode($value)
    {
        $this->data['SdkCode'] = $value;
        $this->options['form_params']['SdkCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppKey($value)
    {
        $this->data['AppKey'] = $value;
        $this->options['form_params']['AppKey'] = $value;

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
}
