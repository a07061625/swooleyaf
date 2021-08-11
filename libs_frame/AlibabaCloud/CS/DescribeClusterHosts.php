<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeClusterHosts extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/hosts';
}
