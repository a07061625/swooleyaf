<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getAsyncMode()
 * @method $this withAsyncMode($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 */
class DescribeGWSClusterPolicy extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
