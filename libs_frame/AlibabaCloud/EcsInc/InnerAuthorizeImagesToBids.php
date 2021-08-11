<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getImageId()
 * @method string getMode()
 * @method $this withMode($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getBid()
 */
class InnerAuthorizeImagesToBids extends Rpc
{
    /**
     * @return $this
     */
    public function withImageId(array $imageId)
    {
        $this->data['ImageId'] = $imageId;
        foreach ($imageId as $i => $iValue) {
            $this->options['query']['ImageId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withBid(array $bid)
    {
        $this->data['Bid'] = $bid;
        foreach ($bid as $i => $iValue) {
            $this->options['query']['Bid.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
