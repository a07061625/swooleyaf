<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getSearchTxt()
 * @method $this withSearchTxt($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class FindOtherInstanceList extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
