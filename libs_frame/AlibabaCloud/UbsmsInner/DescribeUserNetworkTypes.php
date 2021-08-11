<?php

namespace AlibabaCloud\UbsmsInner;

/**
 * @method string getUid()
 * @method $this withUid($value)
 * @method string getServiceCode()
 * @method $this withServiceCode($value)
 * @method array getRegionIds()
 * @method string getBid()
 * @method $this withBid($value)
 */
class DescribeUserNetworkTypes extends Rpc
{
    /**
     * @return $this
     */
    public function withRegionIds(array $regionIds)
    {
        $this->data['RegionIds'] = $regionIds;
        foreach ($regionIds as $i => $iValue) {
            $this->options['query']['RegionIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
