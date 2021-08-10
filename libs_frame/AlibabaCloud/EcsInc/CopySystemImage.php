<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getTransitId()
 * @method $this withTransitId($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getToImageName()
 * @method $this withToImageName($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getToRegionNoList()
 * @method string getToImageDesc()
 * @method $this withToImageDesc($value)
 * @method array getTag()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class CopySystemImage extends Rpc
{
    /**
     * @return $this
     */
    public function withToRegionNoList(array $toRegionNoList)
    {
        $this->data['ToRegionNoList'] = $toRegionNoList;
        foreach ($toRegionNoList as $i => $iValue) {
            $this->options['query']['ToRegionNoList.' . ($i + 1)] = $iValue;
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
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
