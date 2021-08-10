<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getPipelineIds()
 */
class DeletePipelines extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/pipelines';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPipelineIds($value)
    {
        $this->data['PipelineIds'] = $value;
        $this->options['query']['pipelineIds'] = $value;

        return $this;
    }
}
