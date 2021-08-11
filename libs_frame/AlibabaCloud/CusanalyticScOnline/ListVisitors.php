<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getGender()
 * @method string getUkId()
 * @method string getLocationIds()
 * @method string getStartTime()
 * @method string getPageSize()
 * @method string getEnterCount()
 * @method string getPageIndex()
 * @method string getAgeStart()
 * @method string getAgeEnd()
 * @method string getPkId()
 * @method string getEndTime()
 * @method string getStoreIds()
 */
class ListVisitors extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGender($value)
    {
        $this->data['Gender'] = $value;
        $this->options['form_params']['Gender'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUkId($value)
    {
        $this->data['UkId'] = $value;
        $this->options['form_params']['UkId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocationIds($value)
    {
        $this->data['LocationIds'] = $value;
        $this->options['form_params']['LocationIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTime($value)
    {
        $this->data['StartTime'] = $value;
        $this->options['form_params']['StartTime'] = $value;

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
    public function withEnterCount($value)
    {
        $this->data['EnterCount'] = $value;
        $this->options['form_params']['EnterCount'] = $value;

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
    public function withAgeStart($value)
    {
        $this->data['AgeStart'] = $value;
        $this->options['form_params']['AgeStart'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAgeEnd($value)
    {
        $this->data['AgeEnd'] = $value;
        $this->options['form_params']['AgeEnd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPkId($value)
    {
        $this->data['PkId'] = $value;
        $this->options['form_params']['PkId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndTime($value)
    {
        $this->data['EndTime'] = $value;
        $this->options['form_params']['EndTime'] = $value;

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
