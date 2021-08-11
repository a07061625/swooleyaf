<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeClusterServices extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/services';
}
