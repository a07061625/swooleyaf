<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getAlertTemplates()
 */
class CreateMetricRuleTemplate extends Rpc
{
    /**
     * @return $this
     */
    public function withAlertTemplates(array $alertTemplates)
    {
        $this->data['AlertTemplates'] = $alertTemplates;
        foreach ($alertTemplates as $depth1 => $depth1Value) {
            if (isset($depth1Value['Period'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Period'] = $depth1Value['Period'];
            }
            if (isset($depth1Value['EscalationsWarnThreshold'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.Threshold'] = $depth1Value['EscalationsWarnThreshold'];
            }
            if (isset($depth1Value['Webhook'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Webhook'] = $depth1Value['Webhook'];
            }
            if (isset($depth1Value['EscalationsWarnComparisonOperator'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.ComparisonOperator'] = $depth1Value['EscalationsWarnComparisonOperator'];
            }
            if (isset($depth1Value['EscalationsCriticalStatistics'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.Statistics'] = $depth1Value['EscalationsCriticalStatistics'];
            }
            if (isset($depth1Value['EscalationsInfoTimes'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.Times'] = $depth1Value['EscalationsInfoTimes'];
            }
            if (isset($depth1Value['RuleName'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.RuleName'] = $depth1Value['RuleName'];
            }
            if (isset($depth1Value['EscalationsInfoStatistics'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.Statistics'] = $depth1Value['EscalationsInfoStatistics'];
            }
            if (isset($depth1Value['EscalationsCriticalTimes'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.Times'] = $depth1Value['EscalationsCriticalTimes'];
            }
            if (isset($depth1Value['EscalationsInfoComparisonOperator'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.ComparisonOperator'] = $depth1Value['EscalationsInfoComparisonOperator'];
            }
            if (isset($depth1Value['EscalationsWarnStatistics'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.Statistics'] = $depth1Value['EscalationsWarnStatistics'];
            }
            if (isset($depth1Value['EscalationsInfoThreshold'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Info.Threshold'] = $depth1Value['EscalationsInfoThreshold'];
            }
            if (isset($depth1Value['Namespace'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Namespace'] = $depth1Value['Namespace'];
            }
            if (isset($depth1Value['Selector'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Selector'] = $depth1Value['Selector'];
            }
            if (isset($depth1Value['MetricName'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.MetricName'] = $depth1Value['MetricName'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['EscalationsCriticalComparisonOperator'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.ComparisonOperator'] = $depth1Value['EscalationsCriticalComparisonOperator'];
            }
            if (isset($depth1Value['EscalationsWarnTimes'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Warn.Times'] = $depth1Value['EscalationsWarnTimes'];
            }
            if (isset($depth1Value['EscalationsCriticalThreshold'])) {
                $this->options['query']['AlertTemplates.' . ($depth1 + 1) . '.Escalations.Critical.Threshold'] = $depth1Value['EscalationsCriticalThreshold'];
            }
        }

        return $this;
    }
}
