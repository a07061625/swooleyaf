<?php

namespace AlibabaCloud\Rtc;

/**
 * @method string getBackgroundColor()
 * @method $this withBackgroundColor($value)
 * @method string getCropMode()
 * @method $this withCropMode($value)
 * @method string getChannelPrefix()
 * @method $this withChannelPrefix($value)
 * @method string getTaskProfile()
 * @method $this withTaskProfile($value)
 * @method array getLayoutIds()
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getPlayDomain()
 * @method $this withPlayDomain($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getMediaEncode()
 * @method $this withMediaEncode($value)
 * @method string getCallBack()
 * @method $this withCallBack($value)
 */
class CreateMPURule extends Rpc
{
    /**
     * @return $this
     */
    public function withLayoutIds(array $layoutIds)
    {
        $this->data['LayoutIds'] = $layoutIds;
        foreach ($layoutIds as $i => $iValue) {
            $this->options['query']['LayoutIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
