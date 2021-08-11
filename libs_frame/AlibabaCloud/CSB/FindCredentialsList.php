<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getGroupName()
 * @method $this withGroupName($value)
 */
class FindCredentialsList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
