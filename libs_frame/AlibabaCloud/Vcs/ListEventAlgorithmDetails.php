<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getSourceId()
 * @method string getCorpId()
 * @method string getExtendValue()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getPageNumber()
 * @method string getRecordId()
 * @method string getEventValue()
 * @method string getDataSourceId()
 * @method string getPageSize()
 * @method string getEventType()
 */
class ListEventAlgorithmDetails extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceId($value)
    {
        $this->data['SourceId'] = $value;
        $this->options['form_params']['SourceId'] = $value;

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
    public function withExtendValue($value)
    {
        $this->data['ExtendValue'] = $value;
        $this->options['form_params']['ExtendValue'] = $value;

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
    public function withRecordId($value)
    {
        $this->data['RecordId'] = $value;
        $this->options['form_params']['RecordId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEventValue($value)
    {
        $this->data['EventValue'] = $value;
        $this->options['form_params']['EventValue'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSourceId($value)
    {
        $this->data['DataSourceId'] = $value;
        $this->options['form_params']['DataSourceId'] = $value;

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
    public function withEventType($value)
    {
        $this->data['EventType'] = $value;
        $this->options['form_params']['EventType'] = $value;

        return $this;
    }
}
