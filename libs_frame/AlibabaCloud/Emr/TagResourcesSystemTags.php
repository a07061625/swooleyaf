<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getResourceId()
 * @method string getTagOwnerUid()
 * @method $this withTagOwnerUid($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getScope()
 * @method $this withScope($value)
 * @method array getTag()
 */
class TagResourcesSystemTags extends Rpc
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
}
