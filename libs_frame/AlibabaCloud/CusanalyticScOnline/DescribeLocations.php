<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getStoreId()
 */
class DescribeLocations extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }
}
