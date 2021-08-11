<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getStoreId()
 * @method string getStartDate()
 * @method string getEndUserCount()
 * @method string getPageSize()
 * @method string getPageIndex()
 * @method string getStayPeriod()
 * @method string getStartUserCount()
 * @method string getMinSupportCount()
 * @method string getEndDate()
 */
class GetAnalyzeCommodityData extends Rpc
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
    public function withEndUserCount($value)
    {
        $this->data['EndUserCount'] = $value;
        $this->options['form_params']['EndUserCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageIndex($value)
    {
        $this->data['PageIndex'] = $value;
        $this->options['form_params']['PageIndex'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStayPeriod($value)
    {
        $this->data['StayPeriod'] = $value;
        $this->options['form_params']['StayPeriod'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartUserCount($value)
    {
        $this->data['StartUserCount'] = $value;
        $this->options['form_params']['StartUserCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinSupportCount($value)
    {
        $this->data['MinSupportCount'] = $value;
        $this->options['form_params']['MinSupportCount'] = $value;

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
}
