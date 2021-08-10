<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class DescribeTemplates extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/templates';

    /** @var string */
    public $method = 'GET';
}
