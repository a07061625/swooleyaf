<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getStatisticsType()
 * @method string getCorpId()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getDataSourceId()
 */
class ListDevicePersonStatistics extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatisticsType($value)
    {
        $this->data['StatisticsType'] = $value;
        $this->options['form_params']['StatisticsType'] = $value;

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
    public function withDataSourceId($value)
    {
        $this->data['DataSourceId'] = $value;
        $this->options['form_params']['DataSourceId'] = $value;

        return $this;
    }
}
