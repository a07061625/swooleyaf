<?php

namespace AlibabaCloud\SmartHosting;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getManagedPrivateSpaceName()
 * @method $this withManagedPrivateSpaceName($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getTag()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getManagedPrivateSpaceId()
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListManagedPrivateSpaces extends Rpc
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
    public function withManagedPrivateSpaceId(array $managedPrivateSpaceId)
    {
        $this->data['ManagedPrivateSpaceId'] = $managedPrivateSpaceId;
        foreach ($managedPrivateSpaceId as $i => $iValue) {
            $this->options['query']['ManagedPrivateSpaceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
