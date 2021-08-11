<?php

namespace AlibabaCloud\Fnf;

/**
 * @method string getExecutionName()
 * @method string getCause()
 * @method string getError()
 * @method string getRequestId()
 * @method $this withRequestId($value)
 * @method string getFlowName()
 */
class StopExecution extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExecutionName($value)
    {
        $this->data['ExecutionName'] = $value;
        $this->options['form_params']['ExecutionName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCause($value)
    {
        $this->data['Cause'] = $value;
        $this->options['form_params']['Cause'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withError($value)
    {
        $this->data['Error'] = $value;
        $this->options['form_params']['Error'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFlowName($value)
    {
        $this->data['FlowName'] = $value;
        $this->options['form_params']['FlowName'] = $value;

        return $this;
    }
}
