<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getConfirm()
 * @method string getPipelineId()
 */
class ContinuePipeline extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/pipeline_batch_confirm';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfirm($value)
    {
        $this->data['Confirm'] = $value;
        $this->options['query']['Confirm'] = $value;

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
        $this->options['query']['PipelineId'] = $value;

        return $this;
    }
}
