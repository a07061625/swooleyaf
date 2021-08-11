<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getPipelineId()
 * @method $this withPipelineId($value)
 */
class DescribePipeline extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/pipelines/[PipelineId]';

    /** @var string */
    public $method = 'GET';
}
