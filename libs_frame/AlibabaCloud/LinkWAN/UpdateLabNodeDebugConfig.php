<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 * @method string getDebugConfigJson()
 */
class UpdateLabNodeDebugConfig extends Rpc
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
    public function withDebugConfigJson($value)
    {
        $this->data['DebugConfigJson'] = $value;
        $this->options['form_params']['DebugConfigJson'] = $value;

        return $this;
    }
}
