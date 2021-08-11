<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getExpiryTimeEnd()
 * @method $this withExpiryTimeEnd($value)
 * @method string getExpiryTimeStart()
 * @method $this withExpiryTimeStart($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getEffectiveOrNot()
 * @method $this withEffectiveOrNot($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class QueryRedeem extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
