<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getLedgerId()
 * @method $this withLedgerId($value)
 */
class DescribeLedger extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
