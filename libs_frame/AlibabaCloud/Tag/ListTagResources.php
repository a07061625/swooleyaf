<?php

namespace AlibabaCloud\Tag;

/**
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getResourceARN()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 */
class ListTagResources extends Rpc
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
