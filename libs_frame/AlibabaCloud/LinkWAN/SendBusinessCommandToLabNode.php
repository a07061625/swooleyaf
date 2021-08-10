<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 * @method string getDebugConfig()
 * @method string getBusinessCommand()
 */
class SendBusinessCommandToLabNode extends Rpc
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
    public function withDebugConfig($value)
    {
        $this->data['DebugConfig'] = $value;
        $this->options['form_params']['DebugConfig'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBusinessCommand($value)
    {
        $this->data['BusinessCommand'] = $value;
        $this->options['form_params']['BusinessCommand'] = $value;

        return $this;
    }
}
