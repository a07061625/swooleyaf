<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListDataTasks extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/data-task';

    /** @var string */
    public $method = 'GET';
}
