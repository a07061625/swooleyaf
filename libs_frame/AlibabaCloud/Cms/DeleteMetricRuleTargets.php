<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getTargetIds()
 * @method string getRuleId()
 * @method $this withRuleId($value)
 */
class DeleteMetricRuleTargets extends Rpc
{
    /**
     * @return $this
     */
    public function withTargetIds(array $targetIds)
    {
        $this->data['TargetIds'] = $targetIds;
        foreach ($targetIds as $i => $iValue) {
            $this->options['query']['TargetIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
