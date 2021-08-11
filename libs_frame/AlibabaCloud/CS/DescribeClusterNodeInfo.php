<?php

namespace AlibabaCloud\CS;

/**
 * @method string getToken()
 * @method $this withToken($value)
 */
class DescribeClusterNodeInfo extends Roa
{
    /** @var string */
    public $pathPattern = '/token/[Token]/node_info';
}
