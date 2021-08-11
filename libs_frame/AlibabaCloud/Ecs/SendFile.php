<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getTimeout()
 * @method $this withTimeout($value)
 * @method string getContent()
 * @method $this withContent($value)
 * @method string getFileOwner()
 * @method $this withFileOwner($value)
 * @method string getOverwrite()
 * @method $this withOverwrite($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getFileMode()
 * @method $this withFileMode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getContentType()
 * @method $this withContentType($value)
 * @method array getInstanceId()
 * @method string getName()
 * @method $this withName($value)
 * @method string getFileGroup()
 * @method $this withFileGroup($value)
 * @method string getTargetDir()
 * @method $this withTargetDir($value)
 */
class SendFile extends Rpc
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
