<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getLedgerId()
 * @method $this withLedgerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListVpcEndpoints extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
