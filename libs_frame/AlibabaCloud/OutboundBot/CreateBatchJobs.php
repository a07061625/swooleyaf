<?php

namespace AlibabaCloud\OutboundBot;

/**
 * @method string getJobFilePath()
 * @method $this withJobFilePath($value)
 * @method string getScriptId()
 * @method $this withScriptId($value)
 * @method array getCallingNumber()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getSubmitted()
 * @method $this withSubmitted($value)
 * @method string getBatchJobName()
 * @method $this withBatchJobName($value)
 * @method string getStrategyJson()
 * @method $this withStrategyJson($value)
 * @method string getBatchJobDescription()
 * @method $this withBatchJobDescription($value)
 * @method string getScenarioId()
 * @method $this withScenarioId($value)
 */
class CreateBatchJobs extends Rpc
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
