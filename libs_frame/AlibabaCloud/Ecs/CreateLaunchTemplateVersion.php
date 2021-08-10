<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getLaunchTemplateName()
 * @method $this withLaunchTemplateName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSecurityEnhancementStrategy()
 * @method $this withSecurityEnhancementStrategy($value)
 * @method string getNetworkType()
 * @method $this withNetworkType($value)
 * @method string getKeyPairName()
 * @method $this withKeyPairName($value)
 * @method string getSpotPriceLimit()
 * @method $this withSpotPriceLimit($value)
 * @method string getImageOwnerAlias()
 * @method $this withImageOwnerAlias($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getHostName()
 * @method $this withHostName($value)
 * @method string getSystemDiskIops()
 * @method array getTag()
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getSpotStrategy()
 * @method $this withSpotStrategy($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getInternetMaxBandwidthIn()
 * @method $this withInternetMaxBandwidthIn($value)
 * @method string getVersionDescription()
 * @method $this withVersionDescription($value)
 * @method string getSystemDiskDeleteWithInstance()
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getInternetMaxBandwidthOut()
 * @method $this withInternetMaxBandwidthOut($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSystemDiskCategory()
 * @method string getSystemDiskPerformanceLevel()
 * @method string getUserData()
 * @method $this withUserData($value)
 * @method string getPasswordInherit()
 * @method $this withPasswordInherit($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getEnableVmOsConfig()
 * @method $this withEnableVmOsConfig($value)
 * @method array getNetworkInterface()
 * @method string getDeploymentSetId()
 * @method $this withDeploymentSetId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getSystemDiskDiskName()
 * @method string getRamRoleName()
 * @method $this withRamRoleName($value)
 * @method string getAutoReleaseTime()
 * @method $this withAutoReleaseTime($value)
 * @method string getSpotDuration()
 * @method $this withSpotDuration($value)
 * @method array getSecurityGroupIds()
 * @method array getDataDisk()
 * @method string getSystemDiskSize()
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getSystemDiskDescription()
 */
class CreateLaunchTemplateVersion extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSystemDiskIops($value)
    {
        $this->data['SystemDiskIops'] = $value;
        $this->options['query']['SystemDisk.Iops'] = $value;

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
    public function withSystemDiskDeleteWithInstance($value)
    {
        $this->data['SystemDiskDeleteWithInstance'] = $value;
        $this->options['query']['SystemDisk.DeleteWithInstance'] = $value;

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
    public function withSystemDiskPerformanceLevel($value)
    {
        $this->data['SystemDiskPerformanceLevel'] = $value;
        $this->options['query']['SystemDisk.PerformanceLevel'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withNetworkInterface(array $networkInterface)
    {
        $this->data['NetworkInterface'] = $networkInterface;
        foreach ($networkInterface as $depth1 => $depth1Value) {
            if (isset($depth1Value['PrimaryIpAddress'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.PrimaryIpAddress'] = $depth1Value['PrimaryIpAddress'];
            }
            if (isset($depth1Value['VSwitchId'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.VSwitchId'] = $depth1Value['VSwitchId'];
            }
            if (isset($depth1Value['SecurityGroupId'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.SecurityGroupId'] = $depth1Value['SecurityGroupId'];
            }
            if (isset($depth1Value['NetworkInterfaceName'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.NetworkInterfaceName'] = $depth1Value['NetworkInterfaceName'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['NetworkInterface.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
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
            if (isset($depth1Value['Size'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['SnapshotId'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['Encrypted'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Encrypted'] = $depth1Value['Encrypted'];
            }
            if (isset($depth1Value['DiskName'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.DiskName'] = $depth1Value['DiskName'];
            }
            if (isset($depth1Value['Description'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            }
            if (isset($depth1Value['DeleteWithInstance'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.DeleteWithInstance'] = $depth1Value['DeleteWithInstance'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
            if (isset($depth1Value['PerformanceLevel'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.PerformanceLevel'] = $depth1Value['PerformanceLevel'];
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
