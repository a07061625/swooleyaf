<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getCallId()
 * @method $this withCallId($value)
 */
class ListHotlineRecord extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
