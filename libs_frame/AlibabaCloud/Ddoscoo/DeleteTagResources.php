<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getAll()
 * @method $this withAll($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method array getTagKey()
 * @method array getResourceIds()
 */
class DeleteTagResources extends Rpc
{
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
