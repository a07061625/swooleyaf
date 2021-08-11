<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getCommandId()
 * @method $this withCommandId($value)
 * @method string getFrequency()
 * @method $this withFrequency($value)
 * @method string getRepeatMode()
 * @method $this withRepeatMode($value)
 * @method string getWindowsPasswordName()
 * @method $this withWindowsPasswordName($value)
 * @method string getTimed()
 * @method $this withTimed($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getInstanceId()
 * @method string getParameters()
 * @method $this withParameters($value)
 * @method string getUsername()
 * @method $this withUsername($value)
 */
class InvokeCommand extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceId(array $instanceId)
    {
        $this->data['InstanceId'] = $instanceId;
        foreach ($instanceId as $i => $iValue) {
            $this->options['query']['InstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
