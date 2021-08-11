<?php

namespace AlibabaCloud\OutboundBot;

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method array getCallingNumber()
 * @method string getScriptId()
 * @method $this withScriptId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getStrategyJson()
 * @method $this withStrategyJson($value)
 * @method string getJobGroupId()
 * @method $this withJobGroupId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getScenarioId()
 * @method $this withScenarioId($value)
 */
class ModifyJobGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withCallingNumber(array $callingNumber)
    {
        $this->data['CallingNumber'] = $callingNumber;
        foreach ($callingNumber as $i => $iValue) {
            $this->options['query']['CallingNumber.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
