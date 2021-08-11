<?php

namespace AlibabaCloud\SmartHosting;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHostType()
 * @method $this withHostType($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getManagedRackId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getManagedPrivateSpaceId()
 * @method $this withManagedPrivateSpaceId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListManagedRacks extends Rpc
{
    /**
     * @return $this
     */
    public function withManagedRackId(array $managedRackId)
    {
        $this->data['ManagedRackId'] = $managedRackId;
        foreach ($managedRackId as $i => $iValue) {
            $this->options['query']['ManagedRackId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
