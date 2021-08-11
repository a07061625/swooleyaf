<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListAvailableEsInstanceIds extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/available-elasticsearch-for-centralized-management';

    /** @var string */
    public $method = 'GET';
}
