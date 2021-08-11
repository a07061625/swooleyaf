<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getGroupRules()
 * @method string getGroupId()
 * @method $this withGroupId($value)
 */
class PutMonitorGroupDynamicRule extends Rpc
{
    /**
     * @return $this
     */
    public function withGroupRules(array $groupRules)
    {
        $this->data['GroupRules'] = $groupRules;
        foreach ($groupRules as $depth1 => $depth1Value) {
            if (isset($depth1Value['FilterRelation'])) {
                $this->options['query']['GroupRules.' . ($depth1 + 1) . '.FilterRelation'] = $depth1Value['FilterRelation'];
            }
            foreach ($depth1Value['Filters'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['Function'])) {
                    $this->options['query']['GroupRules.' . ($depth1 + 1) . '.Filters.' . ($depth2 + 1) . '.Function'] = $depth2Value['Function'];
                }
                if (isset($depth2Value['Name'])) {
                    $this->options['query']['GroupRules.' . ($depth1 + 1) . '.Filters.' . ($depth2 + 1) . '.Name'] = $depth2Value['Name'];
                }
                if (isset($depth2Value['Value'])) {
                    $this->options['query']['GroupRules.' . ($depth1 + 1) . '.Filters.' . ($depth2 + 1) . '.Value'] = $depth2Value['Value'];
                }
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['GroupRules.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
        }

        return $this;
    }
}
