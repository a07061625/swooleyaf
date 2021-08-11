<?php

namespace AlibabaCloud\VoiceNavigator;

/**
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class ListChatbotInstances extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
