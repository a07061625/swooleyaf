<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListAllNode extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/nodes';

    /** @var string */
    public $method = 'GET';
}
