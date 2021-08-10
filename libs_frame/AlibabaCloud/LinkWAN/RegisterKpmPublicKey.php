<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getPublicKey()
 */
class RegisterKpmPublicKey extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPublicKey($value)
    {
        $this->data['PublicKey'] = $value;
        $this->options['form_params']['PublicKey'] = $value;

        return $this;
    }
}
