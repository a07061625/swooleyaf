<?php

namespace AlibabaCloud\EmasAppmonitor;

/**
 * @method string getAppVersionStrategy()
 * @method string getStartTime()
 * @method string getIntervalMinutes()
 * @method string getUniqueAppId()
 * @method string getCrashStatType()
 * @method string getEndTime()
 * @method array getAppVersion()
 * @method array getErrorType()
 * @method string getErrorCategory()
 */
class QueryCrashTrend extends Rpc
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
     * @param string $value
     *
     * @return $this
     */
    public function withCrashStatType($value)
    {
        $this->data['CrashStatType'] = $value;
        $this->options['form_params']['CrashStatType'] = $value;

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
    public function withErrorType(array $errorType)
    {
        $this->data['ErrorType'] = $errorType;
        foreach ($errorType as $i => $iValue) {
            $this->options['form_params']['ErrorType.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withErrorCategory($value)
    {
        $this->data['ErrorCategory'] = $value;
        $this->options['form_params']['ErrorCategory'] = $value;

        return $this;
    }
}
