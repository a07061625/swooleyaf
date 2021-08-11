<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCasCsbName()
 * @method $this withCasCsbName($value)
 * @method string getData()
 */
class PublishUnionCasService extends Rpc
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
