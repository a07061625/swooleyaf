<?php

namespace AlibabaCloud\VoiceNavigator;

/**
 * @method string getConversationId()
 * @method $this withConversationId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class DescribeConversation extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
