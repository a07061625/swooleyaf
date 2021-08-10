<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getIndexTemplate()
 * @method $this withIndexTemplate($value)
 */
class DescribeIndexTemplate extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/index-templates/[IndexTemplate]';

    /** @var string */
    public $method = 'GET';
}
