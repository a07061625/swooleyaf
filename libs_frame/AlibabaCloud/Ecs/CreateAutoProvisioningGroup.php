<?php

namespace AlibabaCloud\Ecs;

/**
 * @method array getLaunchConfigurationDataDisk()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getLaunchConfigurationSystemDiskCategory()
 * @method string getAutoProvisioningGroupType()
 * @method $this withAutoProvisioningGroupType($value)
 * @method string getLaunchConfigurationSystemDiskPerformanceLevel()
 * @method array getLaunchConfigurationHostNames()
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getLaunchConfigurationImageId()
 * @method string getLaunchConfigurationResourceGroupId()
 * @method string getLaunchConfigurationPassword()
 * @method string getPayAsYouGoAllocationStrategy()
 * @method $this withPayAsYouGoAllocationStrategy($value)
 * @method string getDefaultTargetCapacityType()
 * @method $this withDefaultTargetCapacityType($value)
 * @method string getLaunchConfigurationKeyPairName()
 * @method array getSystemDiskConfig()
 * @method array getDataDiskConfig()
 * @method string getValidUntil()
 * @method $this withValidUntil($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getLaunchConfigurationSystemDiskSize()
 * @method string getLaunchConfigurationInternetMaxBandwidthOut()
 * @method string getLaunchConfigurationHostName()
 * @method string getMinTargetCapacity()
 * @method $this withMinTargetCapacity($value)
 * @method string getMaxSpotPrice()
 * @method $this withMaxSpotPrice($value)
 * @method string getLaunchConfigurationPasswordInherit()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getLaunchConfigurationSecurityGroupId()
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getTerminateInstancesWithExpiration()
 * @method $this withTerminateInstancesWithExpiration($value)
 * @method string getLaunchConfigurationUserData()
 * @method string getLaunchConfigurationCreditSpecification()
 * @method string getLaunchConfigurationInstanceName()
 * @method string getLaunchConfigurationInstanceDescription()
 * @method string getSpotAllocationStrategy()
 * @method $this withSpotAllocationStrategy($value)
 * @method string getTerminateInstances()
 * @method $this withTerminateInstances($value)
 * @method string getLaunchConfigurationSystemDiskName()
 * @method string getLaunchConfigurationSystemDiskDescription()
 * @method string getExcessCapacityTerminationPolicy()
 * @method $this withExcessCapacityTerminationPolicy($value)
 * @method array getLaunchTemplateConfig()
 * @method string getLaunchConfigurationRamRoleName()
 * @method string getLaunchConfigurationInternetMaxBandwidthIn()
 * @method string getSpotInstanceInterruptionBehavior()
 * @method $this withSpotInstanceInterruptionBehavior($value)
 * @method string getLaunchConfigurationSecurityEnhancementStrategy()
 * @method array getLaunchConfigurationTag()
 * @method string getLaunchConfigurationDeploymentSetId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getSpotInstancePoolsToUseCount()
 * @method $this withSpotInstancePoolsToUseCount($value)
 * @method string getLaunchConfigurationInternetChargeType()
 * @method string getLaunchTemplateVersion()
 * @method $this withLaunchTemplateVersion($value)
 * @method string getLaunchConfigurationIoOptimized()
 * @method string getPayAsYouGoTargetCapacity()
 * @method $this withPayAsYouGoTargetCapacity($value)
 * @method string getTotalTargetCapacity()
 * @method $this withTotalTargetCapacity($value)
 * @method string getSpotTargetCapacity()
 * @method $this withSpotTargetCapacity($value)
 * @method string getValidFrom()
 * @method $this withValidFrom($value)
 * @method string getAutoProvisioningGroupName()
 * @method $this withAutoProvisioningGroupName($value)
 */
class CreateAutoProvisioningGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withLaunchConfigurationDataDisk(array $launchConfigurationDataDisk)
    {
        $this->data['LaunchConfigurationDataDisk'] = $launchConfigurationDataDisk;
        foreach ($launchConfigurationDataDisk as $depth1 => $depth1Value) {
            if (isset($depth1Value['PerformanceLevel'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.PerformanceLevel'] = $depth1Value['PerformanceLevel'];
            }
            if (isset($depth1Value['KmsKeyId'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.KmsKeyId'] = $depth1Value['KmsKeyId'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
            if (isset($depth1Value['SnapshotId'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            }
            if (isset($depth1Value['Size'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
            if (isset($depth1Value['DiskName'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.DiskName'] = $depth1Value['DiskName'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['DeleteWithInstance'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.DeleteWithInstance'] = $depth1Value['DeleteWithInstance'];
            }
            if (isset($depth1Value['Encrypted'])) {
                $this->options['query']['LaunchConfiguration.DataDisk.' . ($depth1 + 1) . '.Encrypted'] = $depth1Value['Encrypted'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSystemDiskCategory($value)
    {
        $this->data['LaunchConfigurationSystemDiskCategory'] = $value;
        $this->options['query']['LaunchConfiguration.SystemDiskCategory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSystemDiskPerformanceLevel($value)
    {
        $this->data['LaunchConfigurationSystemDiskPerformanceLevel'] = $value;
        $this->options['query']['LaunchConfiguration.SystemDiskPerformanceLevel'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withLaunchConfigurationHostNames(array $launchConfigurationHostNames)
    {
        $this->data['LaunchConfigurationHostNames'] = $launchConfigurationHostNames;
        foreach ($launchConfigurationHostNames as $i => $iValue) {
            $this->options['query']['LaunchConfiguration.HostNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationImageId($value)
    {
        $this->data['LaunchConfigurationImageId'] = $value;
        $this->options['query']['LaunchConfiguration.ImageId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationResourceGroupId($value)
    {
        $this->data['LaunchConfigurationResourceGroupId'] = $value;
        $this->options['query']['LaunchConfiguration.ResourceGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationPassword($value)
    {
        $this->data['LaunchConfigurationPassword'] = $value;
        $this->options['query']['LaunchConfiguration.Password'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationKeyPairName($value)
    {
        $this->data['LaunchConfigurationKeyPairName'] = $value;
        $this->options['query']['LaunchConfiguration.KeyPairName'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withSystemDiskConfig(array $systemDiskConfig)
    {
        $this->data['SystemDiskConfig'] = $systemDiskConfig;
        foreach ($systemDiskConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['DiskCategory'])) {
                $this->options['query']['SystemDiskConfig.' . ($depth1 + 1) . '.DiskCategory'] = $depth1Value['DiskCategory'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDataDiskConfig(array $dataDiskConfig)
    {
        $this->data['DataDiskConfig'] = $dataDiskConfig;
        foreach ($dataDiskConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['DiskCategory'])) {
                $this->options['query']['DataDiskConfig.' . ($depth1 + 1) . '.DiskCategory'] = $depth1Value['DiskCategory'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSystemDiskSize($value)
    {
        $this->data['LaunchConfigurationSystemDiskSize'] = $value;
        $this->options['query']['LaunchConfiguration.SystemDiskSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationInternetMaxBandwidthOut($value)
    {
        $this->data['LaunchConfigurationInternetMaxBandwidthOut'] = $value;
        $this->options['query']['LaunchConfiguration.InternetMaxBandwidthOut'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationHostName($value)
    {
        $this->data['LaunchConfigurationHostName'] = $value;
        $this->options['query']['LaunchConfiguration.HostName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationPasswordInherit($value)
    {
        $this->data['LaunchConfigurationPasswordInherit'] = $value;
        $this->options['query']['LaunchConfiguration.PasswordInherit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSecurityGroupId($value)
    {
        $this->data['LaunchConfigurationSecurityGroupId'] = $value;
        $this->options['query']['LaunchConfiguration.SecurityGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationUserData($value)
    {
        $this->data['LaunchConfigurationUserData'] = $value;
        $this->options['query']['LaunchConfiguration.UserData'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationCreditSpecification($value)
    {
        $this->data['LaunchConfigurationCreditSpecification'] = $value;
        $this->options['query']['LaunchConfiguration.CreditSpecification'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationInstanceName($value)
    {
        $this->data['LaunchConfigurationInstanceName'] = $value;
        $this->options['query']['LaunchConfiguration.InstanceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationInstanceDescription($value)
    {
        $this->data['LaunchConfigurationInstanceDescription'] = $value;
        $this->options['query']['LaunchConfiguration.InstanceDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSystemDiskName($value)
    {
        $this->data['LaunchConfigurationSystemDiskName'] = $value;
        $this->options['query']['LaunchConfiguration.SystemDiskName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSystemDiskDescription($value)
    {
        $this->data['LaunchConfigurationSystemDiskDescription'] = $value;
        $this->options['query']['LaunchConfiguration.SystemDiskDescription'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withLaunchTemplateConfig(array $launchTemplateConfig)
    {
        $this->data['LaunchTemplateConfig'] = $launchTemplateConfig;
        foreach ($launchTemplateConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
            }
            if (isset($depth1Value['MaxPrice'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.MaxPrice'] = $depth1Value['MaxPrice'];
            }
            if (isset($depth1Value['Priority'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.Priority'] = $depth1Value['Priority'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['WeightedCapacity'])) {
                $this->options['query']['LaunchTemplateConfig.' . ($depth1 + 1) . '.WeightedCapacity'] = $depth1Value['WeightedCapacity'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationRamRoleName($value)
    {
        $this->data['LaunchConfigurationRamRoleName'] = $value;
        $this->options['query']['LaunchConfiguration.RamRoleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationInternetMaxBandwidthIn($value)
    {
        $this->data['LaunchConfigurationInternetMaxBandwidthIn'] = $value;
        $this->options['query']['LaunchConfiguration.InternetMaxBandwidthIn'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationSecurityEnhancementStrategy($value)
    {
        $this->data['LaunchConfigurationSecurityEnhancementStrategy'] = $value;
        $this->options['query']['LaunchConfiguration.SecurityEnhancementStrategy'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withLaunchConfigurationTag(array $launchConfigurationTag)
    {
        $this->data['LaunchConfigurationTag'] = $launchConfigurationTag;
        foreach ($launchConfigurationTag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['LaunchConfiguration.Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['LaunchConfiguration.Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationDeploymentSetId($value)
    {
        $this->data['LaunchConfigurationDeploymentSetId'] = $value;
        $this->options['query']['LaunchConfiguration.DeploymentSetId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationInternetChargeType($value)
    {
        $this->data['LaunchConfigurationInternetChargeType'] = $value;
        $this->options['query']['LaunchConfiguration.InternetChargeType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLaunchConfigurationIoOptimized($value)
    {
        $this->data['LaunchConfigurationIoOptimized'] = $value;
        $this->options['query']['LaunchConfiguration.IoOptimized'] = $value;

        return $this;
    }
}
