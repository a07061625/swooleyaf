<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 * @method string getPinCode()
 * @method string getNodeGroupId()
 */
class AddNodeToGroup extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPinCode($value)
    {
        $this->data['PinCode'] = $value;
        $this->options['form_params']['PinCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }
}
