<?php

namespace AlibabaCloud\OutboundBot;

/**
 * @method string getJobGroupDescription()
 * @method $this withJobGroupDescription($value)
 * @method string getJobGroupName()
 * @method $this withJobGroupName($value)
 * @method string getScriptId()
 * @method $this withScriptId($value)
 * @method array getCallingNumber()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getStrategyJson()
 * @method $this withStrategyJson($value)
 * @method string getScenarioId()
 * @method $this withScenarioId($value)
 */
class CreateJobGroup extends Rpc
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
