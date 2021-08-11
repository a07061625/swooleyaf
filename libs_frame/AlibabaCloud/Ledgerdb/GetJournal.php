<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getJournalId()
 * @method $this withJournalId($value)
 * @method string getLedgerId()
 * @method $this withLedgerId($value)
 */
class GetJournal extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
