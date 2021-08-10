<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListPipelineIds extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/pipeline-ids';
}
