<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListConnectedClusters extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/connected-clusters';

    /** @var string */
    public $method = 'GET';
}
