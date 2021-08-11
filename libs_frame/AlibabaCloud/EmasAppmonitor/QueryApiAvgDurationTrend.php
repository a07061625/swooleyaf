<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getAppVersionStrategy()
 * @method string getStartTime()
 * @method string getIntervalMinutes()
 * @method string getUniqueAppId()
 * @method array getIp()
 * @method string getEndTime()
 * @method array getAppVersion()
 * @method array getUrlPath()
 * @method string getDomain()
 */
class QueryApiAvgDurationTrend extends Rpc
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
     * @return $this
     */
    public function withIp(array $ip)
    {
        $this->data['Ip'] = $ip;
        foreach ($ip as $i => $iValue) {
            $this->options['form_params']['Ip.' . ($i + 1)] = $iValue;
        }

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
    public function withUrlPath(array $urlPath)
    {
        $this->data['UrlPath'] = $urlPath;
        foreach ($urlPath as $i => $iValue) {
            $this->options['form_params']['UrlPath.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomain($value)
    {
        $this->data['Domain'] = $value;
        $this->options['form_params']['Domain'] = $value;

        return $this;
    }
}
