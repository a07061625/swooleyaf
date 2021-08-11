<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getConfirm()
 * @method string getPipelineId()
 */
class ConfirmPipelineBatch extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/changeorder/ConfirmPipelineBatch';

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
