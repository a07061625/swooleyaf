<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSnapshotId()
 * @method $this withSnapshotId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEncryptAlgorithm()
 * @method $this withEncryptAlgorithm($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getDiskName()
 * @method $this withDiskName($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDiskCategory()
 * @method $this withDiskCategory($value)
 * @method string getStorageSetPartitionNumber()
 * @method $this withStorageSetPartitionNumber($value)
 * @method string getMultiAttach()
 * @method $this withMultiAttach($value)
 * @method array getTag()
 * @method string getAdvancedFeatures()
 * @method $this withAdvancedFeatures($value)
 * @method array getArn()
 * @method string getDedicatedBlockStorageClusterId()
 * @method $this withDedicatedBlockStorageClusterId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getPerformanceLevel()
 * @method $this withPerformanceLevel($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getStorageSetId()
 * @method $this withStorageSetId($value)
 * @method string getSize()
 * @method $this withSize($value)
 * @method string getEncrypted()
 * @method $this withEncrypted($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getKMSKeyId()
 * @method $this withKMSKeyId($value)
 */
class CreateDisk extends Rpc
{
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
}
