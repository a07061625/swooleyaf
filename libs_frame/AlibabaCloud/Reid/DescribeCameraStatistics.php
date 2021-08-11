<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getStartTimestamp()
 * @method string getStoreId()
 * @method string getEndTimestamp()
 */
class DescribeCameraStatistics extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTimestamp($value)
    {
        $this->data['StartTimestamp'] = $value;
        $this->options['form_params']['StartTimestamp'] = $value;

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
    public function withEndTimestamp($value)
    {
        $this->data['EndTimestamp'] = $value;
        $this->options['form_params']['EndTimestamp'] = $value;

        return $this;
    }
}
