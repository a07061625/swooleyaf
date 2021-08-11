<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method array getProcess()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ResumeProcesses extends Rpc
{
    /**
     * @return $this
     */
    public function withProcess(array $process)
    {
        $this->data['Process'] = $process;
        foreach ($process as $i => $iValue) {
            $this->options['query']['Process.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
