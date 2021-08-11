<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getStoreId()
 * @method string getImgUrl()
 */
class SearchPersonByImg extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImgUrl($value)
    {
        $this->data['ImgUrl'] = $value;
        $this->options['form_params']['ImgUrl'] = $value;

        return $this;
    }
}
