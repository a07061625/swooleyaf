<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getGatewayInstanceId()
 * @method string getGatewayId()
 */
class DeleteGatewayInstance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGatewayInstanceId($value)
    {
        $this->data['GatewayInstanceId'] = $value;
        $this->options['form_params']['GatewayInstanceId'] = $value;

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
