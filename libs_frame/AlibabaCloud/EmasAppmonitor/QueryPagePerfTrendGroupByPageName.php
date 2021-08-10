<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getMetricType()
 * @method string getAppVersionStrategy()
 * @method string getStartTime()
 * @method string getDeviceLevel()
 * @method array getProvince()
 * @method string getStatType()
 * @method string getIntervalMinutes()
 * @method string getUniqueAppId()
 * @method string getGroupByPageName()
 * @method string getEndTime()
 * @method array getAppVersion()
 */
class QueryPagePerfTrendGroupByPageName extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMetricType($value)
    {
        $this->data['MetricType'] = $value;
        $this->options['form_params']['MetricType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppVersionStrategy($value)
    {
        $this->data['AppVersionStrategy'] = $value;
        $this->options['form_params']['AppVersionStrategy'] = $value;

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
    public function withDeviceLevel($value)
    {
        $this->data['DeviceLevel'] = $value;
        $this->options['form_params']['DeviceLevel'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withProvince(array $province)
    {
        $this->data['Province'] = $province;
        foreach ($province as $i => $iValue) {
            $this->options['form_params']['Province.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatType($value)
    {
        $this->data['StatType'] = $value;
        $this->options['form_params']['StatType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntervalMinutes($value)
    {
        $this->data['IntervalMinutes'] = $value;
        $this->options['form_params']['IntervalMinutes'] = $value;

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
    public function withGroupByPageName($value)
    {
        $this->data['GroupByPageName'] = $value;
        $this->options['form_params']['GroupByPageName'] = $value;

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
     * @return $this
     */
    public function withAppVersion(array $appVersion)
    {
        $this->data['AppVersion'] = $appVersion;
        foreach ($appVersion as $i => $iValue) {
            $this->options['form_params']['AppVersion.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
