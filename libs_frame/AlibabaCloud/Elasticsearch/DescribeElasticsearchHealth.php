<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class DescribeElasticsearchHealth extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/elasticsearch-health';

    /** @var string */
    public $method = 'GET';
}
