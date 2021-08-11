<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getServiceId()
 * @method $this withServiceId($value)
 */
class GetService extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
