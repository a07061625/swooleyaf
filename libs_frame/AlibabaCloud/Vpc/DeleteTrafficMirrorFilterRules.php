<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTrafficMirrorFilterId()
 * @method $this withTrafficMirrorFilterId($value)
 * @method array getTrafficMirrorFilterRuleIds()
 */
class DeleteTrafficMirrorFilterRules extends Rpc
{
    /**
     * @return $this
     */
    public function withTrafficMirrorFilterRuleIds(array $trafficMirrorFilterRuleIds)
    {
        $this->data['TrafficMirrorFilterRuleIds'] = $trafficMirrorFilterRuleIds;
        foreach ($trafficMirrorFilterRuleIds as $i => $iValue) {
            $this->options['query']['TrafficMirrorFilterRuleIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
