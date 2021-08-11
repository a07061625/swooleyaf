<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getData()
 * @method string getIgnoreDauth()
 * @method $this withIgnoreDauth($value)
 * @method string getForce()
 * @method $this withForce($value)
 */
class DeleteCredentialsList extends Rpc
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
