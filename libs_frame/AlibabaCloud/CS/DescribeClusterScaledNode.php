<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeClusterScaledNode extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/scaled_nodes/';
}
