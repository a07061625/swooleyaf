<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getUniqueSuffix()
 * @method $this withUniqueSuffix($value)
 * @method string getSecurityEnhancementStrategy()
 * @method $this withSecurityEnhancementStrategy($value)
 * @method string getMinAmount()
 * @method $this withMinAmount($value)
 * @method string getDeletionProtection()
 * @method $this withDeletionProtection($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPrivatePoolOptionsMatchCriteria()
 * @method string getHostName()
 * @method $this withHostName($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getDeploymentSetGroupNo()
 * @method $this withDeploymentSetGroupNo($value)
 * @method string getSystemDiskAutoSnapshotPolicyId()
 * @method string getCpuOptionsCore()
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getCpuOptionsNuma()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSpotStrategy()
 * @method $this withSpotStrategy($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getPeriodUnit()
 * @method $this withPeriodUnit($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getInternetMaxBandwidthIn()
 * @method $this withInternetMaxBandwidthIn($value)
 * @method string getAffinity()
 * @method $this withAffinity($value)
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getSpotInterruptionBehavior()
 * @method $this withSpotInterruptionBehavior($value)
 * @method string getNetworkInterfaceQueueNumber()
 * @method $this withNetworkInterfaceQueueNumber($value)
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getHibernationOptionsConfigured()
 * @method string getSystemDiskPerformanceLevel()
 * @method string getPasswordInherit()
 * @method $this withPasswordInherit($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method array getArn()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getSchedulerOptionsDedicatedHostClusterId()
 * @method string getSystemDiskDiskName()
 * @method string getDedicatedHostId()
 * @method $this withDedicatedHostId($value)
 * @method string getSpotDuration()
 * @method $this withSpotDuration($value)
 * @method array getSecurityGroupIds()
 * @method string getSystemDiskSize()
 * @method string getImageFamily()
 * @method $this withImageFamily($value)
 * @method string getLaunchTemplateName()
 * @method $this withLaunchTemplateName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHpcClusterId()
 * @method $this withHpcClusterId($value)
 * @method string getHttpPutResponseHopLimit()
 * @method $this withHttpPutResponseHopLimit($value)
 * @method string getIsp()
 * @method $this withIsp($value)
 * @method string getKeyPairName()
 * @method $this withKeyPairName($value)
 * @method string getSpotPriceLimit()
 * @method $this withSpotPriceLimit($value)
 * @method string getStorageSetPartitionNumber()
 * @method $this withStorageSetPartitionNumber($value)
 * @method array getTag()
 * @method string getPrivatePoolOptionsId()
 * @method string getAutoRenewPeriod()
 * @method $this withAutoRenewPeriod($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getIpv6AddressCount()
 * @method $this withIpv6AddressCount($value)
 * @method array getHostNames()
 * @method string getCapacityReservationPreference()
 * @method $this withCapacityReservationPreference($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method array getIpv6Address()
 * @method string getSecurityOptionsConfidentialComputingMode()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInternetMaxBandwidthOut()
 * @method $this withInternetMaxBandwidthOut($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getCpuOptionsThreadsPerCore()
 * @method string getSystemDiskCategory()
 * @method string getSecurityOptionsTrustedSystemMode()
 * @method string getCapacityReservationId()
 * @method $this withCapacityReservationId($value)
 * @method string getUserData()
 * @method $this withUserData($value)
 * @method string getHttpEndpoint()
 * @method $this withHttpEndpoint($value)
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getDeploymentSetId()
 * @method $this withDeploymentSetId($value)
 * @method array getNetworkInterface()
 * @method string getAmount()
 * @method $this withAmount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getTenancy()
 * @method $this withTenancy($value)
 * @method string getRamRoleName()
 * @method $this withRamRoleName($value)
 * @method string getAutoReleaseTime()
 * @method $this withAutoReleaseTime($value)
 * @method string getCreditSpecification()
 * @method $this withCreditSpecification($value)
 * @method string getLaunchTemplateVersion()
 * @method $this withLaunchTemplateVersion($value)
 * @method string getSchedulerOptionsManagedPrivateSpaceId()
 * @method array getDataDisk()
 * @method string getStorageSetId()
 * @method $this withStorageSetId($value)
 * @method string getHttpTokens()
 * @method $this withHttpTokens($value)
 * @method string getSystemDiskDescription()
 */
class RunInstances extends Rpc
{
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
    public function withCpuOptionsCore($value)
    {
        $this->data['CpuOptionsCore'] = $value;
        $this->options['query']['CpuOptions.Core'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCpuOptionsNuma($value)
    {
        $this->data['CpuOptionsNuma'] = $value;
        $this->options['query']['CpuOptions.Numa'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHibernationOptionsConfigured($value)
    {
        $this->data['HibernationOptionsConfigured'] = $value;
        $this->options['query']['HibernationOptions.Configured'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskPerformanceLevel($value)
    {
        $this->data['SystemDiskPerformanceLevel'] = $value;
        $this->options['query']['SystemDisk.PerformanceLevel'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withArn(array $arn)
    {
        $this->data['Arn'] = $arn;
        foreach ($arn as $depth1 => $depth1Value) {
            if (isset($depth1Value['RoleType'])) {
                $this->options['query']['Arn.' . ($depth1 + 1) . '.RoleType'] = $depth1Value['RoleType'];
            }
            if (isset($depth1Value['Rolearn'])) {
                $this->options['query']['Arn.' . ($depth1 + 1) . '.Rolearn'] = $depth1Value['Rolearn'];
            }
            if (isset($depth1Value['AssumeRoleFor'])) {
                $this->options['query']['Arn.' . ($depth1 + 1) . '.AssumeRoleFor'] = $depth1Value['AssumeRoleFor'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchedulerOptionsDedicatedHostClusterId($value)
    {
        $this->data['SchedulerOptionsDedicatedHostClusterId'] = $value;
        $this->options['query']['SchedulerOptions.DedicatedHostClusterId'] = $value;

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
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

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
    public function withHostNames(array $hostNames)
    {
        $this->data['HostNames'] = $hostNames;
        foreach ($hostNames as $i => $iValue) {
            $this->options['query']['HostNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withIpv6Address(array $ipv6Address)
    {
        $this->data['Ipv6Address'] = $ipv6Address;
        foreach ($ipv6Address as $i => $iValue) {
            $this->options['query']['Ipv6Address.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSecurityOptionsConfidentialComputingMode($value)
    {
        $this->data['SecurityOptionsConfidentialComputingMode'] = $value;
        $this->options['query']['SecurityOptions.ConfidentialComputingMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCpuOptionsThreadsPerCore($value)
    {
        $this->data['CpuOptionsThreadsPerCore'] = $value;
        $this->options['query']['CpuOptions.ThreadsPerCore'] = $value;

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
    public function withSecurityOptionsTrustedSystemMode($value)
    {
        $this->data['SecurityOptionsTrustedSystemMode'] = $value;
        $this->options['query']['SecurityOptions.TrustedSystemMode'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withNetworkInterface(array $networkInterface)
    {
        $this->data['NetworkInterface'] = $networkInterface;
        foreach ($networkInterface as $depth1 => $depth1Value) {
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
            }
            if (isset($depth1Value['NetworkInterfaceName'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.NetworkInterfaceName'] = $depth1Value['NetworkInterfaceName'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
            if (isset($depth1Value['SecurityGroupId'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.SecurityGroupId'] = $depth1Value['SecurityGroupId'];
            }
            if (isset($depth1Value['PrimaryIpAddress'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.PrimaryIpAddress'] = $depth1Value['PrimaryIpAddress'];
            }
            if (isset($depth1Value['QueueNumber'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.QueueNumber'] = $depth1Value['QueueNumber'];
            }
            foreach ($depth1Value['SecurityGroupIds'] as $i => $iValue) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.SecurityGroupIds.' . ($i + 1)] = $iValue;
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchedulerOptionsManagedPrivateSpaceId($value)
    {
        $this->data['SchedulerOptionsManagedPrivateSpaceId'] = $value;
        $this->options['query']['SchedulerOptions.ManagedPrivateSpaceId'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withDataDisk(array $dataDisk)
    {
        $this->data['DataDisk'] = $dataDisk;
        foreach ($dataDisk as $depth1 => $depth1Value) {
            if (isset($depth1Value['PerformanceLevel'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.PerformanceLevel'] = $depth1Value['PerformanceLevel'];
            }
            if (isset($depth1Value['AutoSnapshotPolicyId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.AutoSnapshotPolicyId'] = $depth1Value['AutoSnapshotPolicyId'];
            }
            if (isset($depth1Value['Encrypted'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Encrypted'] = $depth1Value['Encrypted'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
            if (isset($depth1Value['SnapshotId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
            if (isset($depth1Value['Size'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['DiskName'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.DiskName'] = $depth1Value['DiskName'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['EncryptAlgorithm'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.EncryptAlgorithm'] = $depth1Value['EncryptAlgorithm'];
            }
            if (isset($depth1Value['DeleteWithInstance'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.DeleteWithInstance'] = $depth1Value['DeleteWithInstance'];
            }
            if (isset($depth1Value['KMSKeyId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.KMSKeyId'] = $depth1Value['KMSKeyId'];
            }
        }

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
