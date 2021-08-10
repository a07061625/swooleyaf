<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class GetElastictask extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/elastic-task';

    /** @var string */
    public $method = 'GET';
}
