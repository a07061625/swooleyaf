<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method array getVSwitchIds()
 * @method string getActiveScalingConfigurationId()
 * @method $this withActiveScalingConfigurationId($value)
 * @method string getOnDemandBaseCapacity()
 * @method $this withOnDemandBaseCapacity($value)
 * @method string getOnDemandPercentageAboveBaseCapacity()
 * @method $this withOnDemandPercentageAboveBaseCapacity($value)
 * @method string getSpotInstanceRemedy()
 * @method $this withSpotInstanceRemedy($value)
 * @method string getScaleOutAmountCheck()
 * @method $this withScaleOutAmountCheck($value)
 * @method string getDefaultCooldown()
 * @method $this withDefaultCooldown($value)
 * @method string getRemovalPolicy1()
 * @method string getRemovalPolicy2()
 * @method string getHealthCheckType()
 * @method $this withHealthCheckType($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getDesiredCapacity()
 * @method $this withDesiredCapacity($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getScalingGroupName()
 * @method $this withScalingGroupName($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCompensateWithOnDemand()
 * @method $this withCompensateWithOnDemand($value)
 * @method string getSpotInstancePools()
 * @method $this withSpotInstancePools($value)
 * @method string getMinSize()
 * @method $this withMinSize($value)
 * @method string getGroupDeletionProtection()
 * @method $this withGroupDeletionProtection($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getLaunchTemplateVersion()
 * @method $this withLaunchTemplateVersion($value)
 * @method string getMaxSize()
 * @method $this withMaxSize($value)
 */
class ModifyScalingGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withVSwitchIds(array $vSwitchIds)
    {
        $this->data['VSwitchIds'] = $vSwitchIds;
        foreach ($vSwitchIds as $i => $iValue) {
            $this->options['query']['VSwitchIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemovalPolicy1($value)
    {
        $this->data['RemovalPolicy1'] = $value;
        $this->options['query']['RemovalPolicy.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemovalPolicy2($value)
    {
        $this->data['RemovalPolicy2'] = $value;
        $this->options['query']['RemovalPolicy.2'] = $value;

        return $this;
    }
}
