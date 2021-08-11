<?php

namespace AlibabaCloud\SmartHosting;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHostType()
 * @method $this withHostType($value)
 * @method string getMode()
 * @method $this withMode($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getTag()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getManagedHostId()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getManagedPrivateSpaceId()
 * @method $this withManagedPrivateSpaceId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getManagedHostName()
 * @method $this withManagedHostName($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListManagedHosts extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withManagedHostId(array $managedHostId)
    {
        $this->data['ManagedHostId'] = $managedHostId;
        foreach ($managedHostId as $i => $iValue) {
            $this->options['query']['ManagedHostId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
