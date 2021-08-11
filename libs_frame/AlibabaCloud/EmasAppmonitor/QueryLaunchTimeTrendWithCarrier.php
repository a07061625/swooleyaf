<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getAppVersionStrategy()
 * @method string getStartTime()
 * @method string getLaunchType()
 * @method string getStatType()
 * @method string getIntervalMinutes()
 * @method string getUniqueAppId()
 * @method string getEndTime()
 * @method array getAppVersion()
 * @method array getCarrier()
 */
class QueryLaunchTimeTrendWithCarrier extends Rpc
{
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
    public function withLaunchType($value)
    {
        $this->data['LaunchType'] = $value;
        $this->options['form_params']['LaunchType'] = $value;

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

    /**
     * @return $this
     */
    public function withCarrier(array $carrier)
    {
        $this->data['Carrier'] = $carrier;
        foreach ($carrier as $i => $iValue) {
            $this->options['form_params']['Carrier.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
