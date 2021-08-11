<?php

namespace AlibabaCloud\Ess;

/**
 * @method array getVSwitchIds()
 * @method string getSpotInstanceRemedy()
 * @method $this withSpotInstanceRemedy($value)
 * @method string getScaleOutAmountCheck()
 * @method $this withScaleOutAmountCheck($value)
 * @method array getTag()
 * @method string getDefaultCooldown()
 * @method $this withDefaultCooldown($value)
 * @method string getMultiAZPolicy()
 * @method $this withMultiAZPolicy($value)
 * @method string getDBInstanceIds()
 * @method $this withDBInstanceIds($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getDesiredCapacity()
 * @method $this withDesiredCapacity($value)
 * @method string getCompensateWithOnDemand()
 * @method $this withCompensateWithOnDemand($value)
 * @method string getMinSize()
 * @method $this withMinSize($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getMaxSize()
 * @method $this withMaxSize($value)
 * @method array getLifecycleHook()
 * @method string getLoadBalancerIds()
 * @method $this withLoadBalancerIds($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOnDemandBaseCapacity()
 * @method $this withOnDemandBaseCapacity($value)
 * @method string getOnDemandPercentageAboveBaseCapacity()
 * @method $this withOnDemandPercentageAboveBaseCapacity($value)
 * @method string getRemovalPolicy1()
 * @method string getRemovalPolicy2()
 * @method string getHealthCheckType()
 * @method $this withHealthCheckType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getScalingGroupName()
 * @method $this withScalingGroupName($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getSpotInstancePools()
 * @method $this withSpotInstancePools($value)
 * @method string getGroupDeletionProtection()
 * @method $this withGroupDeletionProtection($value)
 * @method string getLaunchTemplateVersion()
 * @method $this withLaunchTemplateVersion($value)
 * @method string getScalingPolicy()
 * @method $this withScalingPolicy($value)
 * @method array getVServerGroup()
 */
class CreateScalingGroup extends Rpc
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
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withLifecycleHook(array $lifecycleHook)
    {
        $this->data['LifecycleHook'] = $lifecycleHook;
        foreach ($lifecycleHook as $depth1 => $depth1Value) {
            if (isset($depth1Value['DefaultResult'])) {
                $this->options['query']['LifecycleHook.' . ($depth1 + 1) . '.DefaultResult'] = $depth1Value['DefaultResult'];
            }
            if (isset($depth1Value['LifecycleHookName'])) {
                $this->options['query']['LifecycleHook.' . ($depth1 + 1) . '.LifecycleHookName'] = $depth1Value['LifecycleHookName'];
            }
            if (isset($depth1Value['HeartbeatTimeout'])) {
                $this->options['query']['LifecycleHook.' . ($depth1 + 1) . '.HeartbeatTimeout'] = $depth1Value['HeartbeatTimeout'];
            }
            if (isset($depth1Value['NotificationArn'])) {
                $this->options['query']['LifecycleHook.' . ($depth1 + 1) . '.NotificationArn'] = $depth1Value['NotificationArn'];
            }
            if (isset($depth1Value['NotificationMetadata'])) {
                $this->options['query']['LifecycleHook.' . ($depth1 + 1) . '.NotificationMetadata'] = $depth1Value['NotificationMetadata'];
            }
            if (isset($depth1Value['LifecycleTransition'])) {
                $this->options['query']['LifecycleHook.' . ($depth1 + 1) . '.LifecycleTransition'] = $depth1Value['LifecycleTransition'];
            }
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
                if (isset($depth2Value['Weight'])) {
                    $this->options['query']['VServerGroup.' . ($depth1 + 1) . '.VServerGroupAttribute.' . ($depth2 + 1) . '.Weight'] = $depth2Value['Weight'];
                }
            }
        }

        return $this;
    }
}
