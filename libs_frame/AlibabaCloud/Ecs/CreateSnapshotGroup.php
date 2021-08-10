<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getInstantAccess()
 * @method $this withInstantAccess($value)
 * @method array getExcludeDiskId()
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getInstantAccessRetentionDays()
 * @method $this withInstantAccessRetentionDays($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getName()
 * @method $this withName($value)
 */
class CreateSnapshotGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withExcludeDiskId(array $excludeDiskId)
    {
        $this->data['ExcludeDiskId'] = $excludeDiskId;
        foreach ($excludeDiskId as $i => $iValue) {
            $this->options['query']['ExcludeDiskId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
