<?php

namespace AlibabaCloud\Cdn;

/**
 * @method string getAvailable()
 * @method $this withAvailable($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeUserVipsByDomain extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
