<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getServiceCode()
 */
class CheckCloudProductOpenStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceCode($value)
    {
        $this->data['ServiceCode'] = $value;
        $this->options['form_params']['ServiceCode'] = $value;

        return $this;
    }
}
