<?php

namespace AlibabaCloud\CS;

/**
 * @method string getReqOnce()
 * @method $this withReqOnce($value)
 * @method string getToken()
 * @method $this withToken($value)
 */
class CallbackClusterToken extends Roa
{
    /** @var string */
    public $pathPattern = '/token/[Token]/req_once/[ReqOnce]/callback';

    /** @var string */
    public $method = 'POST';
}
