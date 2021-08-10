<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getPhone()
 * @method $this withPhone($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getTicketStatus()
 * @method $this withTicketStatus($value)
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 */
class SearchTicketByPhone extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
