<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getAlertConfig()
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getProcessName()
 * @method $this withProcessName($value)
 * @method string getMatchExpressFilterRelation()
 * @method $this withMatchExpressFilterRelation($value)
 * @method array getMatchExpress()
 */
class CreateGroupMonitoringAgentProcess extends Rpc
{
    /**
     * @return $this
     */
    public function withAlertConfig(array $alertConfig)
    {
        $this->data['AlertConfig'] = $alertConfig;
        foreach ($alertConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['Times'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.Times'] = $depth1Value['Times'];
            }
            if (isset($depth1Value['NoEffectiveInterval'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.NoEffectiveInterval'] = $depth1Value['NoEffectiveInterval'];
            }
            if (isset($depth1Value['Webhook'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.Webhook'] = $depth1Value['Webhook'];
            }
            if (isset($depth1Value['SilenceTime'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.SilenceTime'] = $depth1Value['SilenceTime'];
            }
            if (isset($depth1Value['Threshold'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.Threshold'] = $depth1Value['Threshold'];
            }
            if (isset($depth1Value['EffectiveInterval'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.EffectiveInterval'] = $depth1Value['EffectiveInterval'];
            }
            if (isset($depth1Value['ComparisonOperator'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.ComparisonOperator'] = $depth1Value['ComparisonOperator'];
            }
            if (isset($depth1Value['EscalationsLevel'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.EscalationsLevel'] = $depth1Value['EscalationsLevel'];
            }
            if (isset($depth1Value['Statistics'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.Statistics'] = $depth1Value['Statistics'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withMatchExpress(array $matchExpress)
    {
        $this->data['MatchExpress'] = $matchExpress;
        foreach ($matchExpress as $depth1 => $depth1Value) {
            if (isset($depth1Value['Function'])) {
                $this->options['query']['MatchExpress.' . ($depth1 + 1) . '.Function'] = $depth1Value['Function'];
            }
            if (isset($depth1Value['Name'])) {
                $this->options['query']['MatchExpress.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['MatchExpress.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }
}
