<?php

namespace AlibabaCloud\Commondriver;

/**
 * @method string getOrderId()
 */
class GetOrderIdByCheckBeforePay extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrderId($value)
    {
        $this->data['OrderId'] = $value;
        $this->options['query']['orderId'] = $value;

        return $this;
    }
}
