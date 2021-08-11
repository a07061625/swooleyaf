<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getSearchTxt()
 * @method $this withSearchTxt($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class FindInstanceList extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
