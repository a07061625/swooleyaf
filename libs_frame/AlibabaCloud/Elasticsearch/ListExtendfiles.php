<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListExtendfiles extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/extendfiles';

    /** @var string */
    public $method = 'GET';
}
