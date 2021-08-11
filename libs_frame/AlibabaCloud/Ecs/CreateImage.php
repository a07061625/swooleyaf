<?php

namespace AlibabaCloud\Ecs;

/**
 * @method array getDiskDeviceMapping()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSnapshotId()
 * @method $this withSnapshotId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getPlatform()
 * @method $this withPlatform($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method array getTag()
 * @method string getArchitecture()
 * @method $this withArchitecture($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getImageFamily()
 * @method $this withImageFamily($value)
 * @method string getImageVersion()
 * @method $this withImageVersion($value)
 */
class CreateImage extends Rpc
{
    /**
     * @return $this
     */
    public function withDiskDeviceMapping(array $diskDeviceMapping)
    {
        $this->data['DiskDeviceMapping'] = $diskDeviceMapping;
        foreach ($diskDeviceMapping as $depth1 => $depth1Value) {
            if (isset($depth1Value['SnapshotId'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            }
            if (isset($depth1Value['Size'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['DiskType'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.DiskType'] = $depth1Value['DiskType'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
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
                $this->options['query']['Tag.' . ($depth1 + 1) . '.value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
