<?php

namespace AlibabaCloud\Domain;

/**
 * @method string getDomainName()
 */
class QueryBookingDomainInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomainName($value)
    {
        $this->data['DomainName'] = $value;
        $this->options['form_params']['DomainName'] = $value;

        return $this;
    }
}
