<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getProductId()
 * @method string getGender()
 * @method string getCity()
 * @method string getUserId()
 * @method string getMac()
 * @method string getProvince()
 * @method string getProductTitle()
 * @method string getBrandId()
 * @method string getSellPrice()
 * @method string getPlat()
 * @method string getComponentId()
 * @method string getAddress()
 * @method string getIp()
 * @method string getMediaId()
 * @method string getPhone()
 * @method string getV()
 * @method string getEnvironmentType()
 * @method string getDistrict()
 * @method string getImei()
 * @method string getPayPrice()
 * @method string getChannelId()
 * @method string getAge()
 * @method string getStatus()
 */
class SendTaokeInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductId($value)
    {
        $this->data['ProductId'] = $value;
        $this->options['form_params']['ProductId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGender($value)
    {
        $this->data['Gender'] = $value;
        $this->options['form_params']['Gender'] = $value;

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
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['form_params']['UserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMac($value)
    {
        $this->data['Mac'] = $value;
        $this->options['form_params']['Mac'] = $value;

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
    public function withProductTitle($value)
    {
        $this->data['ProductTitle'] = $value;
        $this->options['form_params']['ProductTitle'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBrandId($value)
    {
        $this->data['BrandId'] = $value;
        $this->options['form_params']['BrandId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSellPrice($value)
    {
        $this->data['SellPrice'] = $value;
        $this->options['form_params']['SellPrice'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPlat($value)
    {
        $this->data['Plat'] = $value;
        $this->options['form_params']['Plat'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withComponentId($value)
    {
        $this->data['ComponentId'] = $value;
        $this->options['form_params']['ComponentId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddress($value)
    {
        $this->data['Address'] = $value;
        $this->options['form_params']['Address'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIp($value)
    {
        $this->data['Ip'] = $value;
        $this->options['form_params']['Ip'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMediaId($value)
    {
        $this->data['MediaId'] = $value;
        $this->options['form_params']['MediaId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPhone($value)
    {
        $this->data['Phone'] = $value;
        $this->options['form_params']['Phone'] = $value;

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
    public function withEnvironmentType($value)
    {
        $this->data['EnvironmentType'] = $value;
        $this->options['form_params']['EnvironmentType'] = $value;

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
    public function withImei($value)
    {
        $this->data['Imei'] = $value;
        $this->options['form_params']['Imei'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPayPrice($value)
    {
        $this->data['PayPrice'] = $value;
        $this->options['form_params']['PayPrice'] = $value;

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
    public function withAge($value)
    {
        $this->data['Age'] = $value;
        $this->options['form_params']['Age'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['form_params']['Status'] = $value;

        return $this;
    }
}
