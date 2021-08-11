<?php

namespace AlibabaCloud\Dcdn;

/**
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class EnableDcdnDomainOfflineLogDelivery extends Rpc
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
