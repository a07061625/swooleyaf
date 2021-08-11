<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getDeviceSite()
 * @method string getCorpId()
 * @method string getGbId()
 * @method string getBitRate()
 * @method string getDeviceDirection()
 * @method string getDeviceAddress()
 * @method string getDeviceType()
 * @method string getDeviceResolution()
 * @method string getVendor()
 * @method string getDeviceName()
 */
class UpdateDevice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceSite($value)
    {
        $this->data['DeviceSite'] = $value;
        $this->options['form_params']['DeviceSite'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGbId($value)
    {
        $this->data['GbId'] = $value;
        $this->options['form_params']['GbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBitRate($value)
    {
        $this->data['BitRate'] = $value;
        $this->options['form_params']['BitRate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceDirection($value)
    {
        $this->data['DeviceDirection'] = $value;
        $this->options['form_params']['DeviceDirection'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceAddress($value)
    {
        $this->data['DeviceAddress'] = $value;
        $this->options['form_params']['DeviceAddress'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceType($value)
    {
        $this->data['DeviceType'] = $value;
        $this->options['form_params']['DeviceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceResolution($value)
    {
        $this->data['DeviceResolution'] = $value;
        $this->options['form_params']['DeviceResolution'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVendor($value)
    {
        $this->data['Vendor'] = $value;
        $this->options['form_params']['Vendor'] = $value;

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
