<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getReverse()
 * @method $this withReverse($value)
 * @method string getLedgerId()
 * @method $this withLedgerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListTimeAnchors extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
