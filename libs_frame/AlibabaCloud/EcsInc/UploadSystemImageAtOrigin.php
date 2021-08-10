<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getMetaData()
 * @method $this withMetaData($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOsTypeId()
 * @method $this withOsTypeId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getFromRegionNo()
 * @method $this withFromRegionNo($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getImageName()
 * @method $this withImageName($value)
 * @method string getImageUrl()
 * @method $this withImageUrl($value)
 * @method array getTag()
 * @method string getMD5()
 * @method $this withMD5($value)
 */
class UploadSystemImageAtOrigin extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
