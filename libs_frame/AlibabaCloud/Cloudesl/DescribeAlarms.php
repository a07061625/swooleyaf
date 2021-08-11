<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getStoreId()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getAlarmType()
 * @method string getAlarmStatus()
 * @method string getErrorType()
 * @method string getAlarmId()
 * @method string getDeviceMac()
 */
class DescribeAlarms extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

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
    public function withAlarmType($value)
    {
        $this->data['AlarmType'] = $value;
        $this->options['form_params']['AlarmType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlarmStatus($value)
    {
        $this->data['AlarmStatus'] = $value;
        $this->options['form_params']['AlarmStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withErrorType($value)
    {
        $this->data['ErrorType'] = $value;
        $this->options['form_params']['ErrorType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlarmId($value)
    {
        $this->data['AlarmId'] = $value;
        $this->options['form_params']['AlarmId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceMac($value)
    {
        $this->data['DeviceMac'] = $value;
        $this->options['form_params']['DeviceMac'] = $value;

        return $this;
    }
}
