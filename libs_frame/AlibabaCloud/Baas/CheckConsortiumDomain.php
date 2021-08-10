<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getDomainCode()
 */
class CheckConsortiumDomain extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomainCode($value)
    {
        $this->data['DomainCode'] = $value;
        $this->options['form_params']['DomainCode'] = $value;

        return $this;
    }
}
