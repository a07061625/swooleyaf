<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getDate()
 * @method string getStoreId()
 * @method string getEmapId()
 */
class DescribeHeatMap extends Rpc
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
    public function withEmapId($value)
    {
        $this->data['EmapId'] = $value;
        $this->options['form_params']['EmapId'] = $value;

        return $this;
    }
}
