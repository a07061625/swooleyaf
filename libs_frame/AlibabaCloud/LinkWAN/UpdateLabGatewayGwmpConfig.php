<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getGwEui()
 * @method string getGwmpConfig()
 */
class UpdateLabGatewayGwmpConfig extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGwmpConfig($value)
    {
        $this->data['GwmpConfig'] = $value;
        $this->options['form_params']['GwmpConfig'] = $value;

        return $this;
    }
}
