<?php

namespace AlibabaCloud\Fnf;

/**
 * @method string getOutput()
 * @method string getRequestId()
 * @method $this withRequestId($value)
 * @method string getTaskToken()
 * @method $this withTaskToken($value)
 */
class ReportTaskSucceeded extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutput($value)
    {
        $this->data['Output'] = $value;
        $this->options['form_params']['Output'] = $value;

        return $this;
    }
}
