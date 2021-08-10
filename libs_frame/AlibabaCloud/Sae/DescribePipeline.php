<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getPipelineId()
 */
class DescribePipeline extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/changeorder/DescribePipeline';

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
