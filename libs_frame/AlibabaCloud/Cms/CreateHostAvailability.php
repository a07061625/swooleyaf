<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getTaskOptionHttpMethod()
 * @method string getTaskOptionHttpHeader()
 * @method array getAlertConfigEscalationList()
 * @method string getTaskName()
 * @method $this withTaskName($value)
 * @method string getAlertConfigSilenceTime()
 * @method string getTaskOptionHttpResponseCharset()
 * @method string getTaskOptionHttpNegative()
 * @method string getTaskOptionInterval()
 * @method string getAlertConfigNotifyType()
 * @method string getTaskOptionTelnetOrPingHost()
 * @method string getTaskOptionHttpResponseMatchContent()
 * @method array getInstanceList()
 * @method string getTaskType()
 * @method $this withTaskType($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getAlertConfigEndTime()
 * @method string getTaskOptionHttpURI()
 * @method string getTaskScope()
 * @method $this withTaskScope($value)
 * @method string getTaskOptionHttpPostContent()
 * @method string getAlertConfigStartTime()
 * @method string getAlertConfigWebHook()
 */
class CreateHostAvailability extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpMethod($value)
    {
        $this->data['TaskOptionHttpMethod'] = $value;
        $this->options['query']['TaskOption.HttpMethod'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpHeader($value)
    {
        $this->data['TaskOptionHttpHeader'] = $value;
        $this->options['query']['TaskOption.HttpHeader'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withAlertConfigEscalationList(array $alertConfigEscalationList)
    {
        $this->data['AlertConfigEscalationList'] = $alertConfigEscalationList;
        foreach ($alertConfigEscalationList as $depth1 => $depth1Value) {
            if (isset($depth1Value['Times'])) {
                $this->options['query']['AlertConfigEscalationList.' . ($depth1 + 1) . '.Times'] = $depth1Value['Times'];
            }
            if (isset($depth1Value['MetricName'])) {
                $this->options['query']['AlertConfigEscalationList.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['AlertConfigEscalationList.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Operator'])) {
                $this->options['query']['AlertConfigEscalationList.' . ($depth1 + 1) . '.Operator'] = $depth1Value['Operator'];
            }
            if (isset($depth1Value['Aggregate'])) {
                $this->options['query']['AlertConfigEscalationList.' . ($depth1 + 1) . '.Aggregate'] = $depth1Value['Aggregate'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertConfigSilenceTime($value)
    {
        $this->data['AlertConfigSilenceTime'] = $value;
        $this->options['query']['AlertConfig.SilenceTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpResponseCharset($value)
    {
        $this->data['TaskOptionHttpResponseCharset'] = $value;
        $this->options['query']['TaskOption.HttpResponseCharset'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpNegative($value)
    {
        $this->data['TaskOptionHttpNegative'] = $value;
        $this->options['query']['TaskOption.HttpNegative'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionInterval($value)
    {
        $this->data['TaskOptionInterval'] = $value;
        $this->options['query']['TaskOption.Interval'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertConfigNotifyType($value)
    {
        $this->data['AlertConfigNotifyType'] = $value;
        $this->options['query']['AlertConfig.NotifyType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionTelnetOrPingHost($value)
    {
        $this->data['TaskOptionTelnetOrPingHost'] = $value;
        $this->options['query']['TaskOption.TelnetOrPingHost'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpResponseMatchContent($value)
    {
        $this->data['TaskOptionHttpResponseMatchContent'] = $value;
        $this->options['query']['TaskOption.HttpResponseMatchContent'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceList(array $instanceList)
    {
        $this->data['InstanceList'] = $instanceList;
        foreach ($instanceList as $i => $iValue) {
            $this->options['query']['InstanceList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertConfigEndTime($value)
    {
        $this->data['AlertConfigEndTime'] = $value;
        $this->options['query']['AlertConfig.EndTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpURI($value)
    {
        $this->data['TaskOptionHttpURI'] = $value;
        $this->options['query']['TaskOption.HttpURI'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskOptionHttpPostContent($value)
    {
        $this->data['TaskOptionHttpPostContent'] = $value;
        $this->options['query']['TaskOption.HttpPostContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertConfigStartTime($value)
    {
        $this->data['AlertConfigStartTime'] = $value;
        $this->options['query']['AlertConfig.StartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlertConfigWebHook($value)
    {
        $this->data['AlertConfigWebHook'] = $value;
        $this->options['query']['AlertConfig.WebHook'] = $value;

        return $this;
    }
}
