<?php

namespace AlibabaCloud\Emap;

/**
 * @method string getStoreId()
 */
class QueryMapInfoOpen extends Rpc
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
