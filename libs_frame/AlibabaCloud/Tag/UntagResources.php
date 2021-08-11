<?php

namespace AlibabaCloud\Tag;

/**
 * @method array getResourceARN()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getTagKey()
 */
class UntagResources extends Rpc
{
    /**
     * @return $this
     */
    public function withResourceARN(array $resourceARN)
    {
        $this->data['ResourceARN'] = $resourceARN;
        foreach ($resourceARN as $i => $iValue) {
            $this->options['query']['ResourceARN.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTagKey(array $tagKey)
    {
        $this->data['TagKey'] = $tagKey;
        foreach ($tagKey as $i => $iValue) {
            $this->options['query']['TagKey.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
