<?php

namespace AlibabaCloud\Smc;

/**
 * @method string getTargetType()
 * @method $this withTargetType($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getFrequency()
 * @method $this withFrequency($value)
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method string getSystemDiskSize()
 * @method $this withSystemDiskSize($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getContainerRepository()
 * @method $this withContainerRepository($value)
 * @method string getContainerTag()
 * @method $this withContainerTag($value)
 * @method string getContainerNamespace()
 * @method $this withContainerNamespace($value)
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method array getSystemDiskPart()
 * @method string getValidTime()
 * @method $this withValidTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getDataDisk()
 * @method string getLaunchTemplateVersion()
 * @method $this withLaunchTemplateVersion($value)
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
 */
class ModifyReplicationJobAttribute extends Rpc
{
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
