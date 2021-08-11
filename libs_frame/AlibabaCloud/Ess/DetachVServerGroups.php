<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getForceDetach()
 * @method $this withForceDetach($value)
 * @method array getVServerGroup()
 */
class DetachVServerGroups extends Rpc
{
    /**
     * @return $this
     */
    public function withVServerGroup(array $vServerGroup)
    {
        $this->data['VServerGroup'] = $vServerGroup;
        foreach ($vServerGroup as $depth1 => $depth1Value) {
            if (isset($depth1Value['LoadBalancerId'])) {
                $this->options['query']['VServerGroup.' . ($depth1 + 1) . '.LoadBalancerId'] = $depth1Value['LoadBalancerId'];
            }
            foreach ($depth1Value['VServerGroupAttribute'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['VServerGroupId'])) {
                    $this->options['query']['VServerGroup.' . ($depth1 + 1) . '.VServerGroupAttribute.' . ($depth2 + 1) . '.VServerGroupId'] = $depth2Value['VServerGroupId'];
                }
                if (isset($depth2Value['Port'])) {
                    $this->options['query']['VServerGroup.' . ($depth1 + 1) . '.VServerGroupAttribute.' . ($depth2 + 1) . '.Port'] = $depth2Value['Port'];
                }
            }
        }

        return $this;
    }
}
