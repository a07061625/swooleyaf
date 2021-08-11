<?php

namespace AlibabaCloud\Cdn;

/**
 * @method string getTriggerARN()
 * @method $this withTriggerARN($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeFCTrigger extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
