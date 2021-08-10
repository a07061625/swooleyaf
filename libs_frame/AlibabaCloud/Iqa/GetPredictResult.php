<?php

namespace AlibabaCloud\Iqa;

/**
 * @method string getTopK()
 * @method $this withTopK($value)
 * @method string getTraceTag()
 * @method $this withTraceTag($value)
 * @method string getQuestion()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class GetPredictResult extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQuestion($value)
    {
        $this->data['Question'] = $value;
        $this->options['form_params']['Question'] = $value;

        return $this;
    }
}
