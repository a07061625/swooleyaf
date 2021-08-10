<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getTicketId()
 * @method $this withTicketId($value)
 * @method string getStatusCode()
 * @method $this withStatusCode($value)
 */
class SearchTicketById extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
