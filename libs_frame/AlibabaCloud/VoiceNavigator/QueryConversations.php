<?php

namespace AlibabaCloud\VoiceNavigator;

/**
 * @method string getBeginTimeLeftRange()
 * @method $this withBeginTimeLeftRange($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getCallingNumber()
 * @method $this withCallingNumber($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getBeginTimeRightRange()
 * @method $this withBeginTimeRightRange($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class QueryConversations extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
