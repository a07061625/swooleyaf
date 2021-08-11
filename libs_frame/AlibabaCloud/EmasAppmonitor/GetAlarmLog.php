<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getAlarmItemType()
 * @method string getPageNumber()
 * @method string getFromDate()
 * @method string getPageSize()
 * @method string getAlarmItemId()
 * @method string getUniqueAppId()
 * @method string getUntilDate()
 */
class GetAlarmLog extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlarmItemType($value)
    {
        $this->data['AlarmItemType'] = $value;
        $this->options['form_params']['AlarmItemType'] = $value;

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
    public function withFromDate($value)
    {
        $this->data['FromDate'] = $value;
        $this->options['form_params']['FromDate'] = $value;

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
    public function withAlarmItemId($value)
    {
        $this->data['AlarmItemId'] = $value;
        $this->options['form_params']['AlarmItemId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUniqueAppId($value)
    {
        $this->data['UniqueAppId'] = $value;
        $this->options['form_params']['UniqueAppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUntilDate($value)
    {
        $this->data['UntilDate'] = $value;
        $this->options['form_params']['UntilDate'] = $value;

        return $this;
    }
}
