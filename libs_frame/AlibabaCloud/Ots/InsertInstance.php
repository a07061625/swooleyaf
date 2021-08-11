<?php

namespace AlibabaCloud\Ots;

/**
 * @method string getAccessKeyId()
 * @method string getClusterType()
 * @method $this withClusterType($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method array getTagInfo()
 * @method string getNetwork()
 * @method $this withNetwork($value)
 */
class InsertInstance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessKeyId($value)
    {
        $this->data['AccessKeyId'] = $value;
        $this->options['query']['access_key_id'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withTagInfo(array $tagInfo)
    {
        $this->data['TagInfo'] = $tagInfo;
        foreach ($tagInfo as $depth1 => $depth1Value) {
            $this->options['query']['TagInfo.' . ($depth1 + 1) . '.TagValue'] = $depth1Value['TagValue'];
            $this->options['query']['TagInfo.' . ($depth1 + 1) . '.TagKey'] = $depth1Value['TagKey'];
        }

        return $this;
    }
}
