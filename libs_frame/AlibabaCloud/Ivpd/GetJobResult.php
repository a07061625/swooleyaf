<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method string getJobId()
 */
class GetJobResult extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobId($value)
    {
        $this->data['JobId'] = $value;
        $this->options['form_params']['JobId'] = $value;

        return $this;
    }
}
