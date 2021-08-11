<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getBizRegionId()
 * @method $this withBizRegionId($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNetworkType()
 * @method $this withNetworkType($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method array getTagValue()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getVSwitchId()
 * @method string getMetric()
 * @method $this withMetric($value)
 * @method string getTagKey()
 * @method $this withTagKey($value)
 */
class InnerQueryEcsCountByCondition extends Rpc
{
    /**
     * @return $this
     */
    public function withTagValue(array $tagValue)
    {
        $this->data['TagValue'] = $tagValue;
        foreach ($tagValue as $i => $iValue) {
            $this->options['query']['TagValue.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withVSwitchId(array $vSwitchId)
    {
        $this->data['VSwitchId'] = $vSwitchId;
        foreach ($vSwitchId as $i => $iValue) {
            $this->options['query']['VSwitchId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
