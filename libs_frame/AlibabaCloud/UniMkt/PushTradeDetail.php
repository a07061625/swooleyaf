<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getSalePrice()
 * @method string getEndTime()
 * @method string getTradeStatus()
 * @method string getCommodityId()
 * @method string getStartTime()
 * @method string getTradeOrderId()
 * @method string getDeviceSn()
 * @method string getCommodityName()
 * @method string getVerificationStatus()
 * @method string getAlipayOrderId()
 * @method string getChannelId()
 * @method string getOuterTradeId()
 * @method string getTradeTime()
 * @method string getTradePrice()
 */
class PushTradeDetail extends Rpc
{
    /** @var string */
    public $scheme = 'https';

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
    public function withEndTime($value)
    {
        $this->data['EndTime'] = $value;
        $this->options['form_params']['EndTime'] = $value;

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
    public function withStartTime($value)
    {
        $this->data['StartTime'] = $value;
        $this->options['form_params']['StartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTradeOrderId($value)
    {
        $this->data['TradeOrderId'] = $value;
        $this->options['form_params']['TradeOrderId'] = $value;

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
    public function withVerificationStatus($value)
    {
        $this->data['VerificationStatus'] = $value;
        $this->options['form_params']['VerificationStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlipayOrderId($value)
    {
        $this->data['AlipayOrderId'] = $value;
        $this->options['form_params']['AlipayOrderId'] = $value;

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
    public function withOuterTradeId($value)
    {
        $this->data['OuterTradeId'] = $value;
        $this->options['form_params']['OuterTradeId'] = $value;

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
