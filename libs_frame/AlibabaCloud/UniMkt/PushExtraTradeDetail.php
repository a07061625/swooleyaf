<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getOrderId()
 * @method string getSalePrice()
 * @method string getTradeStatus()
 * @method string getCommodityId()
 * @method string getDeviceSn()
 * @method string getChannelId()
 * @method string getCommodityName()
 * @method string getTradeTime()
 * @method string getTradePrice()
 */
class PushExtraTradeDetail extends Rpc
{
    /** @var string */
    public $scheme = 'https';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrderId($value)
    {
        $this->data['OrderId'] = $value;
        $this->options['form_params']['OrderId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSalePrice($value)
    {
        $this->data['SalePrice'] = $value;
        $this->options['form_params']['SalePrice'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTradeStatus($value)
    {
        $this->data['TradeStatus'] = $value;
        $this->options['form_params']['TradeStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommodityId($value)
    {
        $this->data['CommodityId'] = $value;
        $this->options['form_params']['CommodityId'] = $value;

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
    public function withCommodityName($value)
    {
        $this->data['CommodityName'] = $value;
        $this->options['form_params']['CommodityName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTradeTime($value)
    {
        $this->data['TradeTime'] = $value;
        $this->options['form_params']['TradeTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTradePrice($value)
    {
        $this->data['TradePrice'] = $value;
        $this->options['form_params']['TradePrice'] = $value;

        return $this;
    }
}
