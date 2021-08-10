<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCode()
 */
class DescribeInviter extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCode($value)
    {
        $this->data['Code'] = $value;
        $this->options['form_params']['Code'] = $value;

        return $this;
    }
}
