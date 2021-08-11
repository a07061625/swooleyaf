<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getGatewayId()
 */
class CreateGatewayVerifyCode extends Rpc
{
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
