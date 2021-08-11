<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getDate()
 * @method string getStoreId()
 * @method string getSkuId()
 */
class GetFootwearPosition extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDate($value)
    {
        $this->data['Date'] = $value;
        $this->options['form_params']['Date'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSkuId($value)
    {
        $this->data['SkuId'] = $value;
        $this->options['form_params']['SkuId'] = $value;

        return $this;
    }
}
