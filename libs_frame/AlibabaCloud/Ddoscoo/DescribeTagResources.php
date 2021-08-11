<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method array getTags()
 * @method array getResourceIds()
 */
class DescribeTagResources extends Rpc
{
    /**
     * @return $this
     */
    public function withTags(array $tags)
    {
        $this->data['Tags'] = $tags;
        foreach ($tags as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tags.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tags.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withResourceIds(array $resourceIds)
    {
        $this->data['ResourceIds'] = $resourceIds;
        foreach ($resourceIds as $i => $iValue) {
            $this->options['query']['ResourceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
