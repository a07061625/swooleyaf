<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTerminateInstancesWithExpiration()
 * @method $this withTerminateInstancesWithExpiration($value)
 * @method string getDefaultTargetCapacityType()
 * @method $this withDefaultTargetCapacityType($value)
 * @method string getExcessCapacityTerminationPolicy()
 * @method $this withExcessCapacityTerminationPolicy($value)
 * @method array getLaunchTemplateConfig()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAutoProvisioningGroupId()
 * @method $this withAutoProvisioningGroupId($value)
 * @method string getPayAsYouGoTargetCapacity()
 * @method $this withPayAsYouGoTargetCapacity($value)
 * @method string getTotalTargetCapacity()
 * @method $this withTotalTargetCapacity($value)
 * @method string getSpotTargetCapacity()
 * @method $this withSpotTargetCapacity($value)
 * @method string getMaxSpotPrice()
 * @method $this withMaxSpotPrice($value)
 * @method string getAutoProvisioningGroupName()
 * @method $this withAutoProvisioningGroupName($value)
 */
class ModifyAutoProvisioningGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withLaunchTemplateConfig(array $launchTemplateConfig)
    {
        $this->data['LaunchTemplateConfig'] = $launchTemplateConfig;
        foreach ($launchTemplateConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['MaxPrice'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.MaxPrice'] = $depth1Value['MaxPrice'];
            }
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
            }
            if (isset($depth1Value['WeightedCapacity'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.WeightedCapacity'] = $depth1Value['WeightedCapacity'];
            }
            if (isset($depth1Value['Priority'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.Priority'] = $depth1Value['Priority'];
            }
        }

        return $this;
    }
}
