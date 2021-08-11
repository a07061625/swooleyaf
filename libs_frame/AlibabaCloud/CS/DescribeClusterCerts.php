<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeClusterCerts extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/certs';
}
