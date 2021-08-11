<?php

namespace AlibabaCloud\DmsEnterprise;

/**
 * @method string getOrderId()
 * @method string getTid()
 * @method $this withTid($value)
 */
class GetDataExportOrderDetail extends Rpc
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
