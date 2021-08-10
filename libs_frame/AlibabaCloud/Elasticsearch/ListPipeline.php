<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getSize()
 * @method string getPage()
 * @method string getPipelineId()
 */
class ListPipeline extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/logstashes/[InstanceId]/pipelines';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['query']['size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['page'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPipelineId($value)
    {
        $this->data['PipelineId'] = $value;
        $this->options['query']['pipelineId'] = $value;

        return $this;
    }
}
