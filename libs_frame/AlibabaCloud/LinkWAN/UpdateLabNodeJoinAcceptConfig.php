<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 * @method string getDebugConfig()
 * @method string getJoinAcceptConfig()
 */
class UpdateLabNodeJoinAcceptConfig extends Rpc
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
    public function withJoinAcceptConfig($value)
    {
        $this->data['JoinAcceptConfig'] = $value;
        $this->options['form_params']['JoinAcceptConfig'] = $value;

        return $this;
    }
}
