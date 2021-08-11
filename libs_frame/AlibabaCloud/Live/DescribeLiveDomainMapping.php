<?php

namespace AlibabaCloud\Live;

/**
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeLiveDomainMapping extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
