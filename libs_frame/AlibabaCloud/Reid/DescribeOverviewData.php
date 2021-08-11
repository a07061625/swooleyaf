<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getDate()
 * @method string getStoreIds()
 */
class DescribeOverviewData extends Rpc
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
    public function withStoreIds($value)
    {
        $this->data['StoreIds'] = $value;
        $this->options['form_params']['StoreIds'] = $value;

        return $this;
    }
}
