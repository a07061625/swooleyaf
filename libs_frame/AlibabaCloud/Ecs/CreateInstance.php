<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHpcClusterId()
 * @method $this withHpcClusterId($value)
 * @method string getHttpPutResponseHopLimit()
 * @method $this withHttpPutResponseHopLimit($value)
 * @method string getSecurityEnhancementStrategy()
 * @method $this withSecurityEnhancementStrategy($value)
 * @method string getKeyPairName()
 * @method $this withKeyPairName($value)
 * @method string getSpotPriceLimit()
 * @method $this withSpotPriceLimit($value)
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
 * @method string getStorageSetPartitionNumber()
 * @method $this withStorageSetPartitionNumber($value)
 * @method array getTag()
 * @method string getPrivatePoolOptionsId()
 * @method string getAutoRenewPeriod()
 * @method $this withAutoRenewPeriod($value)
 * @method string getNodeControllerId()
 * @method $this withNodeControllerId($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCapacityReservationPreference()
 * @method $this withCapacityReservationPreference($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getSpotStrategy()
 * @method $this withSpotStrategy($value)
 * @method string getPeriodUnit()
 * @method $this withPeriodUnit($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getInternetMaxBandwidthIn()
 * @method $this withInternetMaxBandwidthIn($value)
 * @method string getUseAdditionalService()
 * @method $this withUseAdditionalService($value)
 * @method string getAffinity()
 * @method $this withAffinity($value)
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getVlanId()
 * @method $this withVlanId($value)
 * @method string getSpotInterruptionBehavior()
 * @method $this withSpotInterruptionBehavior($value)
 * @method string getIoOptimized()
 * @method $this withIoOptimized($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getInternetMaxBandwidthOut()
 * @method $this withInternetMaxBandwidthOut($value)
 * @method string getHibernationOptionsConfigured()
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSystemDiskCategory()
 * @method string getCapacityReservationId()
 * @method $this withCapacityReservationId($value)
 * @method string getSystemDiskPerformanceLevel()
 * @method string getUserData()
 * @method $this withUserData($value)
 * @method string getPasswordInherit()
 * @method $this withPasswordInherit($value)
 * @method string getHttpEndpoint()
 * @method $this withHttpEndpoint($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method array getArn()
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getDeploymentSetId()
 * @method $this withDeploymentSetId($value)
 * @method string getInnerIpAddress()
 * @method $this withInnerIpAddress($value)
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
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getCreditSpecification()
 * @method $this withCreditSpecification($value)
 * @method string getSpotDuration()
 * @method $this withSpotDuration($value)
 * @method array getDataDisk()
 * @method string getStorageSetId()
 * @method $this withStorageSetId($value)
 * @method string getSystemDiskSize()
 * @method string getImageFamily()
 * @method $this withImageFamily($value)
 * @method string getHttpTokens()
 * @method $this withHttpTokens($value)
 * @method string getSystemDiskDescription()
 */
class CreateInstance extends Rpc
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
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
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
    public function withArn(array $arn)
    {
        $this->data['Arn'] = $arn;
        foreach ($arn as $depth1 => $depth1Value) {
            if (isset($depth1Value['Rolearn'])) {
                $this->options['query']['Arn.' . ($depth1 + 1) . '.Rolearn'] = $depth1Value['Rolearn'];
            }
            if (isset($depth1Value['RoleType'])) {
                $this->options['query']['Arn.' . ($depth1 + 1) . '.RoleType'] = $depth1Value['RoleType'];
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
    public function withSystemDiskDiskName($value)
    {
        $this->data['SystemDiskDiskName'] = $value;
        $this->options['query']['SystemDisk.DiskName'] = $value;

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
            if (isset($depth1Value['PerformanceLevel'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.PerformanceLevel'] = $depth1Value['PerformanceLevel'];
            }
            if (isset($depth1Value['EncryptAlgorithm'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.EncryptAlgorithm'] = $depth1Value['EncryptAlgorithm'];
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
