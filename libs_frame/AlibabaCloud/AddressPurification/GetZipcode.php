<?php

namespace AlibabaCloud\AddressPurification;

/**
 * @method string getDefaultProvince()
 * @method string getServiceCode()
 * @method string getDefaultCity()
 * @method string getDefaultDistrict()
 * @method string getAppKey()
 * @method string getText()
 */
class GetZipcode extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDefaultProvince($value)
    {
        $this->data['DefaultProvince'] = $value;
        $this->options['form_params']['DefaultProvince'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceCode($value)
    {
        $this->data['ServiceCode'] = $value;
        $this->options['form_params']['ServiceCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDefaultCity($value)
    {
        $this->data['DefaultCity'] = $value;
        $this->options['form_params']['DefaultCity'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDefaultDistrict($value)
    {
        $this->data['DefaultDistrict'] = $value;
        $this->options['form_params']['DefaultDistrict'] = $value;

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
    public function withText($value)
    {
        $this->data['Text'] = $value;
        $this->options['form_params']['Text'] = $value;

        return $this;
    }
}
