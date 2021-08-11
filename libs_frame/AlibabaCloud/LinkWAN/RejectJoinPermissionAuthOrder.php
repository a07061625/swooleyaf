<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getOrderId()
 */
class RejectJoinPermissionAuthOrder extends Rpc
{
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
}
