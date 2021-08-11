<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 */
class DescribeAckOperator extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/ack-clusters/[ClusterId]/operator';

    /** @var string */
    public $method = 'GET';
}
