<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTmsCode()
 * @method $this withTmsCode($value)
 * @method array getOrderItem()
 * @method string getOrderPostFee()
 * @method $this withOrderPostFee($value)
 * @method string getTradeId()
 * @method $this withTradeId($value)
 * @method string getOwnerUserId()
 * @method $this withOwnerUserId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTmsOrderCode()
 * @method $this withTmsOrderCode($value)
 */
class UnicomOrderConfirm extends Rpc
{
    /**
     * @return $this
     */
    public function withOrderItem(array $orderItem)
    {
        $this->data['OrderItem'] = $orderItem;
        foreach ($orderItem as $depth1 => $depth1Value) {
            if (isset($depth1Value['ScItemName'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.ScItemName'] = $depth1Value['ScItemName'];
            }
            if (isset($depth1Value['ItemAmount'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.ItemAmount'] = $depth1Value['ItemAmount'];
            }
            foreach ($depth1Value['SnList'] as $i => $iValue) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.SnList.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['OrderItemId'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.OrderItemId'] = $depth1Value['OrderItemId'];
            }
            if (isset($depth1Value['ScItemCode'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.ScItemCode'] = $depth1Value['ScItemCode'];
            }
            if (isset($depth1Value['ItemQuantity'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.ItemQuantity'] = $depth1Value['ItemQuantity'];
            }
            if (isset($depth1Value['TradeId'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.TradeId'] = $depth1Value['TradeId'];
            }
            if (isset($depth1Value['TradeItemId'])) {
                $this->options['query']['OrderItem.' . ($depth1 + 1) . '.TradeItemId'] = $depth1Value['TradeItemId'];
            }
        }

        return $this;
    }
}
