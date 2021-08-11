<?php

namespace AlibabaCloud\Ecs;

/**
 * @method array getDiskDeviceMapping()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getPlatform()
 * @method $this withPlatform($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getBootMode()
 * @method $this withBootMode($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method array getTag()
 * @method string getArchitecture()
 * @method $this withArchitecture($value)
 * @method string getLicenseType()
 * @method $this withLicenseType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getRoleName()
 * @method $this withRoleName($value)
 * @method string getOSType()
 * @method $this withOSType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ImportImage extends Rpc
{
    /**
     * @return $this
     */
    public function withDiskDeviceMapping(array $diskDeviceMapping)
    {
        $this->data['DiskDeviceMapping'] = $diskDeviceMapping;
        foreach ($diskDeviceMapping as $depth1 => $depth1Value) {
            if (isset($depth1Value['OSSBucket'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.OSSBucket'] = $depth1Value['OSSBucket'];
            }
            if (isset($depth1Value['DiskImSize'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.DiskImSize'] = $depth1Value['DiskImSize'];
            }
            if (isset($depth1Value['Format'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.Format'] = $depth1Value['Format'];
            }
            if (isset($depth1Value['Device'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            }
            if (isset($depth1Value['OSSObject'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.OSSObject'] = $depth1Value['OSSObject'];
            }
            if (isset($depth1Value['DiskImageSize'])) {
                $this->options['query']['DiskDeviceMapping.' . ($depth1 + 1) . '.DiskImageSize'] = $depth1Value['DiskImageSize'];
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
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
