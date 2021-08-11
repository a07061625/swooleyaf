<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 * @method string getDebugConfig()
 * @method string getMacCommand()
 */
class SendMacCommandToLabNode extends Rpc
{
    /** @var string */
    public $scheme = 'http';

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
    public function withMacCommand($value)
    {
        $this->data['MacCommand'] = $value;
        $this->options['form_params']['MacCommand'] = $value;

        return $this;
    }
}
