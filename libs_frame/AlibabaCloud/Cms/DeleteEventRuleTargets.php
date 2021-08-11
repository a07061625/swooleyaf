<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method array getIds()
 */
class DeleteEventRuleTargets extends Rpc
{
    /**
     * @return $this
     */
    public function withIds(array $ids)
    {
        $this->data['Ids'] = $ids;
        foreach ($ids as $i => $iValue) {
            $this->options['query']['Ids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
