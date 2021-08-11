<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getSchema()
 * @method string getCorpId()
 * @method string getAggregateDimension()
 * @method string getImageSourceType()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getPersonId()
 */
class ListPersonTrack extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchema($value)
    {
        $this->data['Schema'] = $value;
        $this->options['form_params']['Schema'] = $value;

        return $this;
    }

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
    public function withAggregateDimension($value)
    {
        $this->data['AggregateDimension'] = $value;
        $this->options['form_params']['AggregateDimension'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageSourceType($value)
    {
        $this->data['ImageSourceType'] = $value;
        $this->options['form_params']['ImageSourceType'] = $value;

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
    public function withPersonId($value)
    {
        $this->data['PersonId'] = $value;
        $this->options['form_params']['PersonId'] = $value;

        return $this;
    }
}
