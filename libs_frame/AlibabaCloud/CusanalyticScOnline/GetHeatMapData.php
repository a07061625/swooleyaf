<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getEMapName()
 * @method string getStoreId()
 */
class GetHeatMapData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEMapName($value)
    {
        $this->data['EMapName'] = $value;
        $this->options['form_params']['EMapName'] = $value;

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
}
