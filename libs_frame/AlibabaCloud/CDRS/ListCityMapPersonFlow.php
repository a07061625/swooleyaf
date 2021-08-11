<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getEndTime()
 * @method string getRange()
 * @method string getStartTime()
 * @method string getOriginDataSourceIdList()
 * @method string getPageNumber()
 * @method string getTargetDataSourceIdList()
 * @method string getPageSize()
 */
class ListCityMapPersonFlow extends Rpc
{
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
    public function withRange($value)
    {
        $this->data['Range'] = $value;
        $this->options['form_params']['Range'] = $value;

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
    public function withOriginDataSourceIdList($value)
    {
        $this->data['OriginDataSourceIdList'] = $value;
        $this->options['form_params']['OriginDataSourceIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetDataSourceIdList($value)
    {
        $this->data['TargetDataSourceIdList'] = $value;
        $this->options['form_params']['TargetDataSourceIdList'] = $value;

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
}
