<?php

namespace AlibabaCloud\Live;

/**
 * @method string getProject()
 * @method $this withProject($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 * @method string getLogstore()
 * @method $this withLogstore($value)
 */
class ListLiveRealtimeLogDeliveryDomains extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
