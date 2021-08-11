<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getGatewayDesc()
 * @method string getGatewayName()
 */
class CreateGateway extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGatewayDesc($value)
    {
        $this->data['GatewayDesc'] = $value;
        $this->options['form_params']['GatewayDesc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGatewayName($value)
    {
        $this->data['GatewayName'] = $value;
        $this->options['form_params']['GatewayName'] = $value;

        return $this;
    }
}
