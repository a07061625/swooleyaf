<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getAlertUser()
 * @method string getEndTime()
 * @method string getBeginTime()
 * @method string getAlertMethods()
 * @method string getPageNumber()
 * @method string getRemindId()
 * @method string getPageSize()
 * @method string getAlertRuleTypes()
 */
class ListAlertMessages extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertUser($value)
    {
        $this->data['AlertUser'] = $value;
        $this->options['form_params']['AlertUser'] = $value;

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
    public function withBeginTime($value)
    {
        $this->data['BeginTime'] = $value;
        $this->options['form_params']['BeginTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertMethods($value)
    {
        $this->data['AlertMethods'] = $value;
        $this->options['form_params']['AlertMethods'] = $value;

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
    public function withRemindId($value)
    {
        $this->data['RemindId'] = $value;
        $this->options['form_params']['RemindId'] = $value;

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
    public function withAlertRuleTypes($value)
    {
        $this->data['AlertRuleTypes'] = $value;
        $this->options['form_params']['AlertRuleTypes'] = $value;

        return $this;
    }
}
