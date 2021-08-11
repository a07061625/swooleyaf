<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getLocation()
 * @method string getDo()
 * @method $this withDo($value)
 * @method string getChannelId()
 * @method $this withChannelId($value)
 */
class JoinChannel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocation($value)
    {
        $this->data['Location'] = $value;
        $this->options['form_params']['Location'] = $value;

        return $this;
    }
}
