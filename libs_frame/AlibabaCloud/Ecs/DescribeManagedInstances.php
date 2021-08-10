<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOsType()
 * @method $this withOsType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method array getInstanceId()
 * @method string getInstanceIp()
 * @method $this withInstanceIp($value)
 * @method string getActivationId()
 * @method $this withActivationId($value)
 */
class DescribeManagedInstances extends Rpc
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
