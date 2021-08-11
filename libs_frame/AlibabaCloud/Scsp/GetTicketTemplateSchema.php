<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 */
class GetTicketTemplateSchema extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
