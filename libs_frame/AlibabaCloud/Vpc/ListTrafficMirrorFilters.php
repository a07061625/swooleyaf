<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getTrafficMirrorFilterIds()
 * @method string getTrafficMirrorFilterName()
 * @method $this withTrafficMirrorFilterName($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListTrafficMirrorFilters extends Rpc
{
    /**
     * @return $this
     */
    public function withTrafficMirrorFilterIds(array $trafficMirrorFilterIds)
    {
        $this->data['TrafficMirrorFilterIds'] = $trafficMirrorFilterIds;
        foreach ($trafficMirrorFilterIds as $i => $iValue) {
            $this->options['query']['TrafficMirrorFilterIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
