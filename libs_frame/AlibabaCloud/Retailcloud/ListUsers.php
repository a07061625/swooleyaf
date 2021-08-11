<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 */
class ListUsers extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
