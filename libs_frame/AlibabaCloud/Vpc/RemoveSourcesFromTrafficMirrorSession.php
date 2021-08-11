<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getTrafficMirrorSourceIds()
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getTrafficMirrorSessionId()
 * @method $this withTrafficMirrorSessionId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class RemoveSourcesFromTrafficMirrorSession extends Rpc
{
    /**
     * @return $this
     */
    public function withTrafficMirrorSourceIds(array $trafficMirrorSourceIds)
    {
        $this->data['TrafficMirrorSourceIds'] = $trafficMirrorSourceIds;
        foreach ($trafficMirrorSourceIds as $i => $iValue) {
            $this->options['query']['TrafficMirrorSourceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
