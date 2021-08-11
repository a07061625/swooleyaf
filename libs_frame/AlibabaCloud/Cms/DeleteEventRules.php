<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getRuleNames()
 */
class DeleteEventRules extends Rpc
{
    /**
     * @return $this
     */
    public function withRuleNames(array $ruleNames)
    {
        $this->data['RuleNames'] = $ruleNames;
        foreach ($ruleNames as $i => $iValue) {
            $this->options['query']['RuleNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
