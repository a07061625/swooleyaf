<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getHpcClusterId()
 * @method $this withHpcClusterId($value)
 * @method string getKeyPairName()
 * @method $this withKeyPairName($value)
 * @method array getSpotPriceLimit()
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPrivatePoolOptionsMatchCriteria()
 * @method string getHostName()
 * @method $this withHostName($value)
 * @method string getInstanceDescription()
 * @method $this withInstanceDescription($value)
 * @method string getSystemDiskAutoSnapshotPolicyId()
 * @method string getPrivatePoolOptionsId()
 * @method string getIpv6AddressCount()
 * @method $this withIpv6AddressCount($value)
 * @method string getCpu()
 * @method $this withCpu($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getScalingConfigurationName()
 * @method $this withScalingConfigurationName($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getScalingConfigurationId()
 * @method $this withScalingConfigurationId($value)
 * @method string getSpotStrategy()
 * @method $this withSpotStrategy($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getAffinity()
 * @method $this withAffinity($value)
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getMemory()
 * @method $this withMemory($value)
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method array getInstanceTypes()
 * @method string getInternetMaxBandwidthOut()
 * @method $this withInternetMaxBandwidthOut($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getSystemDiskCategory()
 * @method string getUserData()
 * @method $this withUserData($value)
 * @method string getPasswordInherit()
 * @method $this withPasswordInherit($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method string getOverride()
 * @method $this withOverride($value)
 * @method string getSchedulerOptions()
 * @method $this withSchedulerOptions($value)
 * @method string getDeploymentSetId()
 * @method $this withDeploymentSetId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getTenancy()
 * @method $this withTenancy($value)
 * @method string getSystemDiskDiskName()
 * @method string getRamRoleName()
 * @method $this withRamRoleName($value)
 * @method string getDedicatedHostId()
 * @method $this withDedicatedHostId($value)
 * @method string getCreditSpecification()
 * @method $this withCreditSpecification($value)
 * @method array getSecurityGroupIds()
 * @method array getDataDisk()
 * @method string getLoadBalancerWeight()
 * @method $this withLoadBalancerWeight($value)
 * @method string getSystemDiskSize()
 * @method string getImageFamily()
 * @method $this withImageFamily($value)
 * @method string getSystemDiskDescription()
 */
class ModifyScalingConfiguration extends Rpc
{
    /**
     * @return $this
     */
    public function withSpotPriceLimit(array $spotPriceLimit)
    {
        $this->data['SpotPriceLimit'] = $spotPriceLimit;
        foreach ($spotPriceLimit as $depth1 => $depth1Value) {
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['SpotPriceLimit.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['PriceLimit'])) {
                $this->options['query']['SpotPriceLimit.' . ($depth1 + 1) . '.PriceLimit'] = $depth1Value['PriceLimit'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrivatePoolOptionsMatchCriteria($value)
    {
        $this->data['PrivatePoolOptionsMatchCriteria'] = $value;
        $this->options['query']['PrivatePoolOptions.MatchCriteria'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskAutoSnapshotPolicyId($value)
    {
        $this->data['SystemDiskAutoSnapshotPolicyId'] = $value;
        $this->options['query']['SystemDisk.AutoSnapshotPolicyId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrivatePoolOptionsId($value)
    {
        $this->data['PrivatePoolOptionsId'] = $value;
        $this->options['query']['PrivatePoolOptions.Id'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceTypes(array $instanceTypes)
    {
        $this->data['InstanceTypes'] = $instanceTypes;
        foreach ($instanceTypes as $i => $iValue) {
            $this->options['query']['InstanceTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskCategory($value)
    {
        $this->data['SystemDiskCategory'] = $value;
        $this->options['query']['SystemDisk.Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskDiskName($value)
    {
        $this->data['SystemDiskDiskName'] = $value;
        $this->options['query']['SystemDisk.DiskName'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withSecurityGroupIds(array $securityGroupIds)
    {
        $this->data['SecurityGroupIds'] = $securityGroupIds;
        foreach ($securityGroupIds as $i => $iValue) {
            $this->options['query']['SecurityGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDataDisk(array $dataDisk)
    {
        $this->data['DataDisk'] = $dataDisk;
        foreach ($dataDisk as $depth1 => $depth1Value) {
            if (isset($depth1Value['DiskName'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.DiskName'] = $depth1Value['DiskName'];
            }
            if (isset($depth1Value['SnapshotId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            }
            if (isset($depth1Value['Size'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['Encrypted'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Encrypted'] = $depth1Value['Encrypted'];
            }
            if (isset($depth1Value['AutoSnapshotPolicyId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.AutoSnapshotPolicyId'] = $depth1Value['AutoSnapshotPolicyId'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['KMSKeyId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.KMSKeyId'] = $depth1Value['KMSKeyId'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
            if (isset($depth1Value['DeleteWithInstance'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.DeleteWithInstance'] = $depth1Value['DeleteWithInstance'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskSize($value)
    {
        $this->data['SystemDiskSize'] = $value;
        $this->options['query']['SystemDisk.Size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskDescription($value)
    {
        $this->data['SystemDiskDescription'] = $value;
        $this->options['query']['SystemDisk.Description'] = $value;

        return $this;
    }
}
