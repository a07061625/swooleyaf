<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getOwnerBid()
 * @method $this withOwnerBid($value)
 * @method string getScope()
 * @method $this withScope($value)
 * @method string getOwnerUid()
 * @method $this withOwnerUid($value)
 * @method array getResourceId()
 * @method string getTagValue()
 * @method $this withTagValue($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getRelatedKey()
 * @method $this withRelatedKey($value)
 */
class AddSystemTag extends Rpc
{
    /**
     * @return $this
     */
    public function withResourceId(array $resourceId)
    {
        $this->data['ResourceId'] = $resourceId;
        foreach ($resourceId as $i => $iValue) {
            $this->options['query']['ResourceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
