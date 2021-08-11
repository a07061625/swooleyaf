<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getTimeInterval()
 * @method string getRecordNumber()
 * @method string getDataSourceId()
 */
class ListCityMapImageDetails extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeInterval($value)
    {
        $this->data['TimeInterval'] = $value;
        $this->options['form_params']['TimeInterval'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRecordNumber($value)
    {
        $this->data['RecordNumber'] = $value;
        $this->options['form_params']['RecordNumber'] = $value;

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
