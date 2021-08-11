<?php

namespace AlibabaCloud\CS;

/**
 * @method string getToken()
 * @method $this withToken($value)
 */
class GatherLogsToken extends Roa
{
    /** @var string */
    public $pathPattern = '/token/[Token]/gather_logs';

    /** @var string */
    public $method = 'POST';
}
