<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class DescribeLogstash extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]';

    /** @var string */
    public $method = 'GET';
}
