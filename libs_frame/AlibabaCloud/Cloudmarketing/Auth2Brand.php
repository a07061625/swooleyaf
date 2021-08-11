<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getBrandId()
 * @method $this withBrandId($value)
 * @method array getChannelBrandReqs()
 */
class Auth2Brand extends Rpc
{
    /**
     * @return $this
     */
    public function withChannelBrandReqs(array $channelBrandReqs)
    {
        $this->data['ChannelBrandReqs'] = $channelBrandReqs;
        foreach ($channelBrandReqs as $depth1 => $depth1Value) {
            $this->options['query']['ChannelBrandReqs.' . ($depth1 + 1) . '.ChannelType'] = $depth1Value['ChannelType'];
            foreach ($depth1Value['OuterBrandId'] as $i => $iValue) {
                $this->options['query']['ChannelBrandReqs.' . ($depth1 + 1) . '.OuterBrandId.' . ($i + 1)] = $iValue;
            }
        }

        return $this;
    }
}
