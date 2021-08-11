<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getChangeOrderId()
 */
class GetChangeOrderInfo extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/change_order_info';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChangeOrderId($value)
    {
        $this->data['ChangeOrderId'] = $value;
        $this->options['query']['ChangeOrderId'] = $value;

        return $this;
    }
}
