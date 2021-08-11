<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getLedgerId()
 * @method $this withLedgerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getClue()
 * @method $this withClue($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getMemberId()
 * @method $this withMemberId($value)
 */
class ListJournals extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
