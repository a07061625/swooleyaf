<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getBeginDdHHmm()
 * @method $this withBeginDdHHmm($value)
 * @method string getEndDdHHmm()
 * @method $this withEndDdHHmm($value)
 */
class FindBrokerSLOHisList extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
