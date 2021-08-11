<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class DescribeXpackMonitorConfig extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/xpack-monitor-config';

    /** @var string */
    public $method = 'GET';
}
