<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListSnapshotReposByInstanceId extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/snapshot-repos';

    /** @var string */
    public $method = 'GET';
}
