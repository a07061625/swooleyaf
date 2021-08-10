<?php

namespace AlibabaCloud\Alb;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method array getRuleIds()
 */
class DeleteRules extends Rpc
{
    /**
     * @return $this
     */
    public function withRuleIds(array $ruleIds)
    {
        $this->data['RuleIds'] = $ruleIds;
        foreach ($ruleIds as $i => $iValue) {
            $this->options['query']['RuleIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
