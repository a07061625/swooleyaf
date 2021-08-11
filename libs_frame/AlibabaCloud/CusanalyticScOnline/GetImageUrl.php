<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getOriginUrls()
 * @method string getStoreId()
 * @method string getObjectKeys()
 */
class GetImageUrl extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOriginUrls($value)
    {
        $this->data['OriginUrls'] = $value;
        $this->options['form_params']['OriginUrls'] = $value;

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
    public function withObjectKeys($value)
    {
        $this->data['ObjectKeys'] = $value;
        $this->options['form_params']['ObjectKeys'] = $value;

        return $this;
    }
}
