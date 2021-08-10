<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getDomainCode()
 * @method string getDomain()
 */
class CheckOrganizationDomain extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomain($value)
    {
        $this->data['Domain'] = $value;
        $this->options['form_params']['Domain'] = $value;

        return $this;
    }
}
