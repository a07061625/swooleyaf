<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getGatewayDesc()
 * @method string getGatewayName()
 * @method string getGatewayId()
 */
class ModifyGateway extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGatewayId($value)
    {
        $this->data['GatewayId'] = $value;
        $this->options['form_params']['GatewayId'] = $value;

        return $this;
    }
}
