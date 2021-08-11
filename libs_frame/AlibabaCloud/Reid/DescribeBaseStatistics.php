<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getDate()
 * @method string getExtraStatisticTypes()
 * @method string getStoreId()
 * @method string getSummaryType()
 * @method string getLocationId()
 */
class DescribeBaseStatistics extends Rpc
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
    public function withExtraStatisticTypes($value)
    {
        $this->data['ExtraStatisticTypes'] = $value;
        $this->options['form_params']['ExtraStatisticTypes'] = $value;

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
    public function withSummaryType($value)
    {
        $this->data['SummaryType'] = $value;
        $this->options['form_params']['SummaryType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocationId($value)
    {
        $this->data['LocationId'] = $value;
        $this->options['form_params']['LocationId'] = $value;

        return $this;
    }
}
