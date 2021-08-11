<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getOrderId()
 * @method $this withOrderId($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class GetOrder extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
