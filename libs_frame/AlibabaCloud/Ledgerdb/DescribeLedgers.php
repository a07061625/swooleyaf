<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class DescribeLedgers extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
