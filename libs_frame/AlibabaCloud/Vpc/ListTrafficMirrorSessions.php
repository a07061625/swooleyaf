<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTrafficMirrorSourceId()
 * @method $this withTrafficMirrorSourceId($value)
 * @method string getEnabled()
 * @method $this withEnabled($value)
 * @method string getTrafficMirrorSessionName()
 * @method $this withTrafficMirrorSessionName($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getTrafficMirrorSessionIds()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getPriority()
 * @method $this withPriority($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTrafficMirrorTargetId()
 * @method $this withTrafficMirrorTargetId($value)
 * @method string getTrafficMirrorFilterId()
 * @method $this withTrafficMirrorFilterId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getVirtualNetworkId()
 * @method $this withVirtualNetworkId($value)
 */
class ListTrafficMirrorSessions extends Rpc
{
    /**
     * @return $this
     */
    public function withTrafficMirrorSessionIds(array $trafficMirrorSessionIds)
    {
        $this->data['TrafficMirrorSessionIds'] = $trafficMirrorSessionIds;
        foreach ($trafficMirrorSessionIds as $i => $iValue) {
            $this->options['query']['TrafficMirrorSessionIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
