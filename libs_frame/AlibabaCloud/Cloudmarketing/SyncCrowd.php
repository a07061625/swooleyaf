<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method string getOuterAccountNo()
 * @method $this withOuterAccountNo($value)
 * @method array getChannelBrands()
 * @method string getChannelType()
 * @method $this withChannelType($value)
 * @method string getCrowdId()
 * @method $this withCrowdId($value)
 */
class SyncCrowd extends Rpc
{
    /**
     * @return $this
     */
    public function withChannelBrands(array $channelBrands)
    {
        $this->data['ChannelBrands'] = $channelBrands;
        foreach ($channelBrands as $depth1 => $depth1Value) {
            $this->options['query']['ChannelBrands.' . ($depth1 + 1) . '.OuterBrandId'] = $depth1Value['OuterBrandId'];
            $this->options['query']['ChannelBrands.' . ($depth1 + 1) . '.OuterBrandName'] = $depth1Value['OuterBrandName'];
        }

        return $this;
    }
}
