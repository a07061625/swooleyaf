<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getType()
 * @method string getStoreId()
 * @method string getPageNumber()
 * @method string getEslBarCode()
 * @method string getPageSize()
 * @method string getEslStatus()
 * @method string getToBatteryLevel()
 * @method string getFromBatteryLevel()
 */
class DescribeEslDevices extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

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
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEslBarCode($value)
    {
        $this->data['EslBarCode'] = $value;
        $this->options['form_params']['EslBarCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEslStatus($value)
    {
        $this->data['EslStatus'] = $value;
        $this->options['form_params']['EslStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToBatteryLevel($value)
    {
        $this->data['ToBatteryLevel'] = $value;
        $this->options['form_params']['ToBatteryLevel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFromBatteryLevel($value)
    {
        $this->data['FromBatteryLevel'] = $value;
        $this->options['form_params']['FromBatteryLevel'] = $value;

        return $this;
    }
}
