<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getWebhook()
 * @method $this withWebhook($value)
 * @method string getEscalationsWarnComparisonOperator()
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method string getEscalationsInfoStatistics()
 * @method string getEffectiveInterval()
 * @method $this withEffectiveInterval($value)
 * @method string getEscalationsInfoComparisonOperator()
 * @method string getNoEffectiveInterval()
 * @method $this withNoEffectiveInterval($value)
 * @method string getEmailSubject()
 * @method $this withEmailSubject($value)
 * @method string getSilenceTime()
 * @method $this withSilenceTime($value)
 * @method string getMetricName()
 * @method $this withMetricName($value)
 * @method string getEscalationsWarnTimes()
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getEscalationsWarnThreshold()
 * @method string getContactGroups()
 * @method $this withContactGroups($value)
 * @method string getEscalationsCriticalStatistics()
 * @method string getResources()
 * @method $this withResources($value)
 * @method string getEscalationsInfoTimes()
 * @method string getGroupBy()
 * @method $this withGroupBy($value)
 * @method string getEscalationsCriticalTimes()
 * @method string getEscalationsWarnStatistics()
 * @method string getEscalationsInfoThreshold()
 * @method string getNamespace()
 * @method $this withNamespace($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 * @method string getRuleId()
 * @method $this withRuleId($value)
 * @method string getEscalationsCriticalComparisonOperator()
 * @method string getEscalationsCriticalThreshold()
 */
class PutResourceMetricRule extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsWarnComparisonOperator($value)
    {
        $this->data['EscalationsWarnComparisonOperator'] = $value;
        $this->options['query']['Escalations.Warn.ComparisonOperator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsInfoStatistics($value)
    {
        $this->data['EscalationsInfoStatistics'] = $value;
        $this->options['query']['Escalations.Info.Statistics'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsInfoComparisonOperator($value)
    {
        $this->data['EscalationsInfoComparisonOperator'] = $value;
        $this->options['query']['Escalations.Info.ComparisonOperator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsWarnTimes($value)
    {
        $this->data['EscalationsWarnTimes'] = $value;
        $this->options['query']['Escalations.Warn.Times'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsWarnThreshold($value)
    {
        $this->data['EscalationsWarnThreshold'] = $value;
        $this->options['query']['Escalations.Warn.Threshold'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsCriticalStatistics($value)
    {
        $this->data['EscalationsCriticalStatistics'] = $value;
        $this->options['query']['Escalations.Critical.Statistics'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsInfoTimes($value)
    {
        $this->data['EscalationsInfoTimes'] = $value;
        $this->options['query']['Escalations.Info.Times'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsCriticalTimes($value)
    {
        $this->data['EscalationsCriticalTimes'] = $value;
        $this->options['query']['Escalations.Critical.Times'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsWarnStatistics($value)
    {
        $this->data['EscalationsWarnStatistics'] = $value;
        $this->options['query']['Escalations.Warn.Statistics'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsInfoThreshold($value)
    {
        $this->data['EscalationsInfoThreshold'] = $value;
        $this->options['query']['Escalations.Info.Threshold'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsCriticalComparisonOperator($value)
    {
        $this->data['EscalationsCriticalComparisonOperator'] = $value;
        $this->options['query']['Escalations.Critical.ComparisonOperator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEscalationsCriticalThreshold($value)
    {
        $this->data['EscalationsCriticalThreshold'] = $value;
        $this->options['query']['Escalations.Critical.Threshold'] = $value;

        return $this;
    }
}
