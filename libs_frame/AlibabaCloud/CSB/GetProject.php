<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 */
class GetProject extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
