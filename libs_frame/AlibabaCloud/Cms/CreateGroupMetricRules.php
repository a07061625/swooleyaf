<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method array getGroupMetricRules()
 */
class CreateGroupMetricRules extends Rpc
{
    /**
     * @return $this
     */
    public function withGroupMetricRules(array $groupMetricRules)
    {
        $this->data['GroupMetricRules'] = $groupMetricRules;
        foreach ($groupMetricRules as $depth1 => $depth1Value) {
            if (isset($depth1Value['Webhook'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Webhook'] = $depth1Value['Webhook'];
            }
            if (isset($depth1Value['EscalationsWarnComparisonOperator'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Warn.ComparisonOperator'] = $depth1Value['EscalationsWarnComparisonOperator'];
            }
            if (isset($depth1Value['RuleName'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.RuleName'] = $depth1Value['RuleName'];
            }
            if (isset($depth1Value['EscalationsInfoStatistics'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Info.Statistics'] = $depth1Value['EscalationsInfoStatistics'];
            }
            if (isset($depth1Value['EffectiveInterval'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.EffectiveInterval'] = $depth1Value['EffectiveInterval'];
            }
            if (isset($depth1Value['EscalationsInfoComparisonOperator'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Info.ComparisonOperator'] = $depth1Value['EscalationsInfoComparisonOperator'];
            }
            if (isset($depth1Value['NoEffectiveInterval'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.NoEffectiveInterval'] = $depth1Value['NoEffectiveInterval'];
            }
            if (isset($depth1Value['EmailSubject'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.EmailSubject'] = $depth1Value['EmailSubject'];
            }
            if (isset($depth1Value['SilenceTime'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.SilenceTime'] = $depth1Value['SilenceTime'];
            }
            if (isset($depth1Value['MetricName'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            }
            if (isset($depth1Value['EscalationsWarnTimes'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Warn.Times'] = $depth1Value['EscalationsWarnTimes'];
            }
            if (isset($depth1Value['Period'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['EscalationsWarnThreshold'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Warn.Threshold'] = $depth1Value['EscalationsWarnThreshold'];
            }
            if (isset($depth1Value['EscalationsCriticalStatistics'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Critical.Statistics'] = $depth1Value['EscalationsCriticalStatistics'];
            }
            if (isset($depth1Value['EscalationsInfoTimes'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Info.Times'] = $depth1Value['EscalationsInfoTimes'];
            }
            if (isset($depth1Value['EscalationsCriticalTimes'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Critical.Times'] = $depth1Value['EscalationsCriticalTimes'];
            }
            if (isset($depth1Value['EscalationsWarnStatistics'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Warn.Statistics'] = $depth1Value['EscalationsWarnStatistics'];
            }
            if (isset($depth1Value['EscalationsInfoThreshold'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Info.Threshold'] = $depth1Value['EscalationsInfoThreshold'];
            }
            if (isset($depth1Value['Namespace'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Namespace'] = $depth1Value['Namespace'];
            }
            if (isset($depth1Value['Interval'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Interval'] = $depth1Value['Interval'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['RuleId'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.RuleId'] = $depth1Value['RuleId'];
            }
            if (isset($depth1Value['EscalationsCriticalComparisonOperator'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Critical.ComparisonOperator'] = $depth1Value['EscalationsCriticalComparisonOperator'];
            }
            if (isset($depth1Value['EscalationsCriticalThreshold'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Escalations.Critical.Threshold'] = $depth1Value['EscalationsCriticalThreshold'];
            }
            if (isset($depth1Value['Dimensions'])) {
                $this->options['query']['GroupMetricRules.' . ($depth1 + 1) . '.Dimensions'] = $depth1Value['Dimensions'];
            }
        }

        return $this;
    }
}
