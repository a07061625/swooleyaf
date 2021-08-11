<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method array getEventPattern()
 * @method string getEventType()
 * @method $this withEventType($value)
 * @method string getState()
 * @method $this withState($value)
 */
class PutEventRule extends Rpc
{
    /**
     * @return $this
     */
    public function withEventPattern(array $eventPattern)
    {
        $this->data['EventPattern'] = $eventPattern;
        foreach ($eventPattern as $depth1 => $depth1Value) {
            foreach ($depth1Value['LevelList'] as $i => $iValue) {
                $this->options['query']['EventPattern.' . ($depth1 + 1) . '.LevelList.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['Product'])) {
                $this->options['query']['EventPattern.' . ($depth1 + 1) . '.Product'] = $depth1Value['Product'];
            }
            foreach ($depth1Value['StatusList'] as $i => $iValue) {
                $this->options['query']['EventPattern.' . ($depth1 + 1) . '.StatusList.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['NameList'] as $i => $iValue) {
                $this->options['query']['EventPattern.' . ($depth1 + 1) . '.NameList.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['EventTypeList'] as $i => $iValue) {
                $this->options['query']['EventPattern.' . ($depth1 + 1) . '.EventTypeList.' . ($i + 1)] = $iValue;
            }
        }

        return $this;
    }
}
