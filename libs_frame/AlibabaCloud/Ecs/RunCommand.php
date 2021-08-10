<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getWorkingDir()
 * @method $this withWorkingDir($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getCommandContent()
 * @method $this withCommandContent($value)
 * @method string getTimeout()
 * @method $this withTimeout($value)
 * @method string getFrequency()
 * @method $this withFrequency($value)
 * @method string getContentEncoding()
 * @method $this withContentEncoding($value)
 * @method string getRepeatMode()
 * @method $this withRepeatMode($value)
 * @method string getWindowsPasswordName()
 * @method $this withWindowsPasswordName($value)
 * @method string getKeepCommand()
 * @method $this withKeepCommand($value)
 * @method string getTimed()
 * @method $this withTimed($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getInstanceId()
 * @method string getName()
 * @method $this withName($value)
 * @method string getParameters()
 * @method $this withParameters($value)
 * @method string getEnableParameter()
 * @method $this withEnableParameter($value)
 * @method string getUsername()
 * @method $this withUsername($value)
 */
class RunCommand extends Rpc
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
