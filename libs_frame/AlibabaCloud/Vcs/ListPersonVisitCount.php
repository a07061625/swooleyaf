<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getEndTime()
 * @method string getCountType()
 * @method string getStartTime()
 * @method string getPageNumber()
 * @method string getTimeAggregateType()
 * @method string getMaxVal()
 * @method string getTagCode()
 * @method string getMinVal()
 * @method string getPageSize()
 * @method string getAggregateType()
 */
class ListPersonVisitCount extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

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
    public function withCountType($value)
    {
        $this->data['CountType'] = $value;
        $this->options['form_params']['CountType'] = $value;

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
    public function withTimeAggregateType($value)
    {
        $this->data['TimeAggregateType'] = $value;
        $this->options['form_params']['TimeAggregateType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxVal($value)
    {
        $this->data['MaxVal'] = $value;
        $this->options['form_params']['MaxVal'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTagCode($value)
    {
        $this->data['TagCode'] = $value;
        $this->options['form_params']['TagCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinVal($value)
    {
        $this->data['MinVal'] = $value;
        $this->options['form_params']['MinVal'] = $value;

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
    public function withAggregateType($value)
    {
        $this->data['AggregateType'] = $value;
        $this->options['form_params']['AggregateType'] = $value;

        return $this;
    }
}
