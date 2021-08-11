<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 */
class GetLabNodeDownlinkConfig extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDevEui($value)
    {
        $this->data['DevEui'] = $value;
        $this->options['form_params']['DevEui'] = $value;

        return $this;
    }
}
