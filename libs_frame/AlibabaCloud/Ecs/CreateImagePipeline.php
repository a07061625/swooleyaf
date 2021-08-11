<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getBaseImageType()
 * @method $this withBaseImageType($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getToRegionId()
 * @method string getInternetMaxBandwidthOut()
 * @method $this withInternetMaxBandwidthOut($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method string getSystemDiskSize()
 * @method $this withSystemDiskSize($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method array getTag()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBaseImage()
 * @method $this withBaseImage($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method array getAddAccount()
 * @method string getDeleteInstanceOnFailure()
 * @method $this withDeleteInstanceOnFailure($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getBuildContent()
 * @method $this withBuildContent($value)
 */
class CreateImagePipeline extends Rpc
{
    /**
     * @return $this
     */
    public function withToRegionId(array $toRegionId)
    {
        $this->data['ToRegionId'] = $toRegionId;
        foreach ($toRegionId as $i => $iValue) {
            $this->options['query']['ToRegionId.' . ($i + 1)] = $iValue;
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
     * @return $this
     */
    public function withAddAccount(array $addAccount)
    {
        $this->data['AddAccount'] = $addAccount;
        foreach ($addAccount as $i => $iValue) {
            $this->options['query']['AddAccount.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
