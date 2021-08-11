<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getGwEui()
 */
class TriggerLabGatewayDeviceInfoReport extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGwEui($value)
    {
        $this->data['GwEui'] = $value;
        $this->options['form_params']['GwEui'] = $value;

        return $this;
    }
}
