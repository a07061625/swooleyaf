<?php

namespace AlibabaCloud\Smc;

/**
 * @method string getFrequency()
 * @method $this withFrequency($value)
 * @method string getReplicationParameters()
 * @method $this withReplicationParameters($value)
 * @method string getSystemDiskSize()
 * @method $this withSystemDiskSize($value)
 * @method array getTag()
 * @method string getNetMode()
 * @method $this withNetMode($value)
 * @method string getContainerNamespace()
 * @method $this withContainerNamespace($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getValidTime()
 * @method $this withValidTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getScheduledStartTime()
 * @method $this withScheduledStartTime($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getInstanceRamRole()
 * @method $this withInstanceRamRole($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getMaxNumberOfImageToKeep()
 * @method $this withMaxNumberOfImageToKeep($value)
 * @method string getTargetType()
 * @method $this withTargetType($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getContainerRepository()
 * @method $this withContainerRepository($value)
 * @method string getContainerTag()
 * @method $this withContainerTag($value)
 * @method string getSourceId()
 * @method $this withSourceId($value)
 * @method string getRunOnce()
 * @method $this withRunOnce($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method array getSystemDiskPart()
 * @method array getDataDisk()
 * @method string getLaunchTemplateVersion()
 * @method $this withLaunchTemplateVersion($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 */
class CreateReplicationJob extends Rpc
{
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
    public function withSystemDiskPart(array $systemDiskPart)
    {
        $this->data['SystemDiskPart'] = $systemDiskPart;
        foreach ($systemDiskPart as $depth1 => $depth1Value) {
            if (isset($depth1Value['SizeBytes'])) {
                $this->options['query']['SystemDiskPart.' . ($depth1 + 1) . '.SizeBytes'] = $depth1Value['SizeBytes'];
            }
            if (isset($depth1Value['Block'])) {
                $this->options['query']['SystemDiskPart.' . ($depth1 + 1) . '.Block'] = $depth1Value['Block'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['SystemDiskPart.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
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
            foreach ($depth1Value['Part'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['SizeBytes'])) {
                    $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Part.' . ($depth2 + 1) . '.SizeBytes'] = $depth2Value['SizeBytes'];
                }
                if (isset($depth2Value['Block'])) {
                    $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Part.' . ($depth2 + 1) . '.Block'] = $depth2Value['Block'];
                }
                if (isset($depth2Value['Device'])) {
                    $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Part.' . ($depth2 + 1) . '.Device'] = $depth2Value['Device'];
                }
            }
            if (isset($depth1Value['Index'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Index'] = $depth1Value['Index'];
            }
        }

        return $this;
    }
}
