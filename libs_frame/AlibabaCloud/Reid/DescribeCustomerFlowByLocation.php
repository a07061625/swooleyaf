<?php

namespace AlibabaCloud\Reid;

/**
 * @method string getStartDate()
 * @method string getStoreId()
 * @method string getMinCount()
 * @method string getParentAmount()
 * @method string getMaxCount()
 * @method string getEndDate()
 * @method string getLocationId()
 * @method string getParentLocationIds()
 */
class DescribeCustomerFlowByLocation extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartDate($value)
    {
        $this->data['StartDate'] = $value;
        $this->options['form_params']['StartDate'] = $value;

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
    public function withMinCount($value)
    {
        $this->data['MinCount'] = $value;
        $this->options['form_params']['MinCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentAmount($value)
    {
        $this->data['ParentAmount'] = $value;
        $this->options['form_params']['ParentAmount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxCount($value)
    {
        $this->data['MaxCount'] = $value;
        $this->options['form_params']['MaxCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndDate($value)
    {
        $this->data['EndDate'] = $value;
        $this->options['form_params']['EndDate'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentLocationIds($value)
    {
        $this->data['ParentLocationIds'] = $value;
        $this->options['form_params']['ParentLocationIds'] = $value;

        return $this;
    }
}
