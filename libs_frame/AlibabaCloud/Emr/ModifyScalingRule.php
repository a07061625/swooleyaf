<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method string getScalingRuleId()
 * @method $this withScalingRuleId($value)
 * @method string getRecurrenceEndTime()
 * @method $this withRecurrenceEndTime($value)
 * @method array getCloudWatchTrigger()
 * @method string getTimeoutWithGrace()
 * @method $this withTimeoutWithGrace($value)
 * @method string getCooldown()
 * @method $this withCooldown($value)
 * @method string getLaunchTime()
 * @method $this withLaunchTime($value)
 * @method string getWithGrace()
 * @method $this withWithGrace($value)
 * @method string getAdjustmentValue()
 * @method $this withAdjustmentValue($value)
 * @method string getAdjustmentType()
 * @method $this withAdjustmentType($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getLaunchExpirationTime()
 * @method $this withLaunchExpirationTime($value)
 * @method string getRecurrenceValue()
 * @method $this withRecurrenceValue($value)
 * @method string getHostGroupId()
 * @method $this withHostGroupId($value)
 * @method array getSchedulerTrigger()
 * @method string getRecurrenceType()
 * @method $this withRecurrenceType($value)
 */
class ModifyScalingRule extends Rpc
{
    /**
     * @return $this
     */
    public function withCloudWatchTrigger(array $cloudWatchTrigger)
    {
        $this->data['CloudWatchTrigger'] = $cloudWatchTrigger;
        foreach ($cloudWatchTrigger as $depth1 => $depth1Value) {
            if (isset($depth1Value['Period'])) {
                $this->options['query']['CloudWatchTrigger.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['EvaluationCount'])) {
                $this->options['query']['CloudWatchTrigger.' . ($depth1 + 1) . '.EvaluationCount'] = $depth1Value['EvaluationCount'];
            }
            if (isset($depth1Value['Threshold'])) {
                $this->options['query']['CloudWatchTrigger.' . ($depth1 + 1) . '.Threshold'] = $depth1Value['Threshold'];
            }
            if (isset($depth1Value['MetricName'])) {
                $this->options['query']['CloudWatchTrigger.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            }
            if (isset($depth1Value['ComparisonOperator'])) {
                $this->options['query']['CloudWatchTrigger.' . ($depth1 + 1) . '.ComparisonOperator'] = $depth1Value['ComparisonOperator'];
            }
            if (isset($depth1Value['Statistics'])) {
                $this->options['query']['CloudWatchTrigger.' . ($depth1 + 1) . '.Statistics'] = $depth1Value['Statistics'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSchedulerTrigger(array $schedulerTrigger)
    {
        $this->data['SchedulerTrigger'] = $schedulerTrigger;
        foreach ($schedulerTrigger as $depth1 => $depth1Value) {
            if (isset($depth1Value['LaunchTime'])) {
                $this->options['query']['SchedulerTrigger.' . ($depth1 + 1) . '.LaunchTime'] = $depth1Value['LaunchTime'];
            }
            if (isset($depth1Value['LaunchExpirationTime'])) {
                $this->options['query']['SchedulerTrigger.' . ($depth1 + 1) . '.LaunchExpirationTime'] = $depth1Value['LaunchExpirationTime'];
            }
            if (isset($depth1Value['RecurrenceValue'])) {
                $this->options['query']['SchedulerTrigger.' . ($depth1 + 1) . '.RecurrenceValue'] = $depth1Value['RecurrenceValue'];
            }
            if (isset($depth1Value['RecurrenceEndTime'])) {
                $this->options['query']['SchedulerTrigger.' . ($depth1 + 1) . '.RecurrenceEndTime'] = $depth1Value['RecurrenceEndTime'];
            }
            if (isset($depth1Value['RecurrenceType'])) {
                $this->options['query']['SchedulerTrigger.' . ($depth1 + 1) . '.RecurrenceType'] = $depth1Value['RecurrenceType'];
            }
        }

        return $this;
    }
}
