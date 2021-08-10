<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getPhoneNum()
 * @method $this withPhoneNum($value)
 */
class GetNumLocation extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
