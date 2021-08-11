<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getGwEui()
 */
class RebootLabGateway extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGwEui($value)
    {
        $this->data['GwEui'] = $value;
        $this->options['form_params']['GwEui'] = $value;

        return $this;
    }
}
