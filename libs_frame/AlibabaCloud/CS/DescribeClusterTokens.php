<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeClusterTokens extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/tokens';
}
