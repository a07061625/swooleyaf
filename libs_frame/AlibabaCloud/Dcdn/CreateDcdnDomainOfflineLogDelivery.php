<?php

namespace AlibabaCloud\Dcdn;

/**
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getFieldId()
 */
class CreateDcdnDomainOfflineLogDelivery extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFieldId($value)
    {
        $this->data['FieldId'] = $value;
        $this->options['form_params']['FieldId'] = $value;

        return $this;
    }
}
