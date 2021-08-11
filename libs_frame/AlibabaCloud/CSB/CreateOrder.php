<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getData()
 * @method string getCsbId()
 * @method $this withCsbId($value)
 */
class CreateOrder extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withData($value)
    {
        $this->data['Data'] = $value;
        $this->options['form_params']['Data'] = $value;

        return $this;
    }
}
