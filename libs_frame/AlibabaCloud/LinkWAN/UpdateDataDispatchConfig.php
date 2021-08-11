<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getUplinkTopic()
 * @method string getProductKey()
 * @method string getProductType()
 * @method string getProductName()
 * @method string getUplinkRegionName()
 * @method string getNodeGroupId()
 * @method string getDataDispatchDestination()
 */
class UpdateDataDispatchConfig extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUplinkTopic($value)
    {
        $this->data['UplinkTopic'] = $value;
        $this->options['form_params']['UplinkTopic'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductKey($value)
    {
        $this->data['ProductKey'] = $value;
        $this->options['form_params']['ProductKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductType($value)
    {
        $this->data['ProductType'] = $value;
        $this->options['form_params']['ProductType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductName($value)
    {
        $this->data['ProductName'] = $value;
        $this->options['form_params']['ProductName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUplinkRegionName($value)
    {
        $this->data['UplinkRegionName'] = $value;
        $this->options['form_params']['UplinkRegionName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataDispatchDestination($value)
    {
        $this->data['DataDispatchDestination'] = $value;
        $this->options['form_params']['DataDispatchDestination'] = $value;

        return $this;
    }
}
