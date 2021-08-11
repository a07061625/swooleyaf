<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getRules()
 */
class PutResourceMetricRules extends Rpc
{
    /**
     * @return $this
     */
    public function withRules(array $rules)
    {
        $this->data['Rules'] = $rules;
        foreach ($rules as $depth1 => $depth1Value) {
            if (isset($depth1Value['Webhook'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Webhook'] = $depth1Value['Webhook'];
            }
            if (isset($depth1Value['EscalationsWarnComparisonOperator'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Warn.ComparisonOperator'] = $depth1Value['EscalationsWarnComparisonOperator'];
            }
            if (isset($depth1Value['RuleName'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.RuleName'] = $depth1Value['RuleName'];
            }
            if (isset($depth1Value['EscalationsInfoStatistics'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Info.Statistics'] = $depth1Value['EscalationsInfoStatistics'];
            }
            if (isset($depth1Value['EffectiveInterval'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.EffectiveInterval'] = $depth1Value['EffectiveInterval'];
            }
            if (isset($depth1Value['EscalationsInfoComparisonOperator'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Info.ComparisonOperator'] = $depth1Value['EscalationsInfoComparisonOperator'];
            }
            if (isset($depth1Value['NoEffectiveInterval'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.NoEffectiveInterval'] = $depth1Value['NoEffectiveInterval'];
            }
            if (isset($depth1Value['EmailSubject'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.EmailSubject'] = $depth1Value['EmailSubject'];
            }
            if (isset($depth1Value['SilenceTime'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.SilenceTime'] = $depth1Value['SilenceTime'];
            }
            if (isset($depth1Value['MetricName'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            }
            if (isset($depth1Value['EscalationsWarnTimes'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Warn.Times'] = $depth1Value['EscalationsWarnTimes'];
            }
            if (isset($depth1Value['Period'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['EscalationsWarnThreshold'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Warn.Threshold'] = $depth1Value['EscalationsWarnThreshold'];
            }
            if (isset($depth1Value['ContactGroups'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.ContactGroups'] = $depth1Value['ContactGroups'];
            }
            if (isset($depth1Value['EscalationsCriticalStatistics'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Critical.Statistics'] = $depth1Value['EscalationsCriticalStatistics'];
            }
            if (isset($depth1Value['Resources'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Resources'] = $depth1Value['Resources'];
            }
            if (isset($depth1Value['EscalationsInfoTimes'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Info.Times'] = $depth1Value['EscalationsInfoTimes'];
            }
            if (isset($depth1Value['EscalationsCriticalTimes'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Critical.Times'] = $depth1Value['EscalationsCriticalTimes'];
            }
            if (isset($depth1Value['EscalationsWarnStatistics'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Warn.Statistics'] = $depth1Value['EscalationsWarnStatistics'];
            }
            if (isset($depth1Value['EscalationsInfoThreshold'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Info.Threshold'] = $depth1Value['EscalationsInfoThreshold'];
            }
            if (isset($depth1Value['Namespace'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Namespace'] = $depth1Value['Namespace'];
            }
            if (isset($depth1Value['Interval'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Interval'] = $depth1Value['Interval'];
            }
            if (isset($depth1Value['RuleId'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.RuleId'] = $depth1Value['RuleId'];
            }
            if (isset($depth1Value['EscalationsCriticalComparisonOperator'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Critical.ComparisonOperator'] = $depth1Value['EscalationsCriticalComparisonOperator'];
            }
            if (isset($depth1Value['EscalationsCriticalThreshold'])) {
                $this->options['query']['Rules.' . ($depth1 + 1) . '.Escalations.Critical.Threshold'] = $depth1Value['EscalationsCriticalThreshold'];
            }
        }

        return $this;
    }
}
