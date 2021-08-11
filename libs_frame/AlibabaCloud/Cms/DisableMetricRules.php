<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getRuleId()
 */
class DisableMetricRules extends Rpc
{
    /**
     * @return $this
     */
    public function withRuleId(array $ruleId)
    {
        $this->data['RuleId'] = $ruleId;
        foreach ($ruleId as $i => $iValue) {
            $this->options['query']['RuleId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
