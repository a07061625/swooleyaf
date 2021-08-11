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
 * @method string getTags()
 * @method $this withTags($value)
 */
class TagResources extends Rpc
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
}
