<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getOnlyImported()
 * @method $this withOnlyImported($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class FindInstanceNodeList extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
