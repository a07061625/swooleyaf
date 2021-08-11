<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getFirstScene()
 * @method string getDetailAddr()
 * @method string getCity()
 * @method string getDeviceType()
 * @method string getLocationName()
 * @method string getProvince()
 * @method string getDistrict()
 * @method string getDeviceName()
 * @method string getDeviceModelNumber()
 * @method string getSecondScene()
 * @method string getFloor()
 * @method string getChannelId()
 * @method string getOuterCode()
 */
class RegistDevice extends Rpc
{
    /** @var string */
    public $scheme = 'https';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFirstScene($value)
    {
        $this->data['FirstScene'] = $value;
        $this->options['form_params']['FirstScene'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDetailAddr($value)
    {
        $this->data['DetailAddr'] = $value;
        $this->options['form_params']['DetailAddr'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCity($value)
    {
        $this->data['City'] = $value;
        $this->options['form_params']['City'] = $value;

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
    public function withLocationName($value)
    {
        $this->data['LocationName'] = $value;
        $this->options['form_params']['LocationName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProvince($value)
    {
        $this->data['Province'] = $value;
        $this->options['form_params']['Province'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDistrict($value)
    {
        $this->data['District'] = $value;
        $this->options['form_params']['District'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceModelNumber($value)
    {
        $this->data['DeviceModelNumber'] = $value;
        $this->options['form_params']['DeviceModelNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSecondScene($value)
    {
        $this->data['SecondScene'] = $value;
        $this->options['form_params']['SecondScene'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFloor($value)
    {
        $this->data['Floor'] = $value;
        $this->options['form_params']['Floor'] = $value;

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
    public function withOuterCode($value)
    {
        $this->data['OuterCode'] = $value;
        $this->options['form_params']['OuterCode'] = $value;

        return $this;
    }
}
