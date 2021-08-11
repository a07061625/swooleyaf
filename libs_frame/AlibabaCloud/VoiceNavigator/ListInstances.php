<?php

namespace AlibabaCloud\VoiceNavigator;

/**
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class ListInstances extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
