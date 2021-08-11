<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class UpdateSnapshotSetting extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/snapshot-setting';
}
