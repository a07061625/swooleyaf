<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getStoreId()
 */
class ListEmap extends Rpc
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
