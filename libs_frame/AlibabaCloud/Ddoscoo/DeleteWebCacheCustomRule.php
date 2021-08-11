<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method array getRuleNames()
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class DeleteWebCacheCustomRule extends Rpc
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
