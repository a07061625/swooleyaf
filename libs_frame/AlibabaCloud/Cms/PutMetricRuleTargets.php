<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getTargets()
 * @method string getRuleId()
 * @method $this withRuleId($value)
 */
class PutMetricRuleTargets extends Rpc
{
    /**
     * @return $this
     */
    public function withTargets(array $targets)
    {
        $this->data['Targets'] = $targets;
        foreach ($targets as $depth1 => $depth1Value) {
            if (isset($depth1Value['Level'])) {
                $this->options['query']['Targets.' . ($depth1 + 1) . '.Level'] = $depth1Value['Level'];
            }
            if (isset($depth1Value['Id'])) {
                $this->options['query']['Targets.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['Arn'])) {
                $this->options['query']['Targets.' . ($depth1 + 1) . '.Arn'] = $depth1Value['Arn'];
            }
        }

        return $this;
    }
}
