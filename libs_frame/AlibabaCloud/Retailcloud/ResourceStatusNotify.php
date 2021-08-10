<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getData()
 */
class ResourceStatusNotify extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withData($value)
    {
        $this->data['Data'] = $value;
        $this->options['form_params']['data'] = $value;

        return $this;
    }
}
