<?php

namespace AlibabaCloud\Cdn;

/**
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getConfigId()
 * @method $this withConfigId($value)
 */
class ListDomainsByLogConfigId extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
