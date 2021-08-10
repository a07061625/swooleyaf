<?php

namespace AlibabaCloud\Rtc;

/**
 * @method array getFormats()
 * @method string getOssFilePrefix()
 * @method $this withOssFilePrefix($value)
 * @method string getBackgroundColor()
 * @method $this withBackgroundColor($value)
 * @method string getTaskProfile()
 * @method $this withTaskProfile($value)
 * @method array getLayoutIds()
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOssBucket()
 * @method $this withOssBucket($value)
 * @method string getMnsQueue()
 * @method $this withMnsQueue($value)
 * @method string getFileSplitInterval()
 * @method $this withFileSplitInterval($value)
 * @method string getHttpCallbackUrl()
 * @method $this withHttpCallbackUrl($value)
 * @method array getWatermarks()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method array getBackgrounds()
 * @method string getName()
 * @method $this withName($value)
 * @method string getMediaEncode()
 * @method $this withMediaEncode($value)
 */
class UpdateRecordTemplate extends Rpc
{
    /**
     * @return $this
     */
    public function withFormats(array $formats)
    {
        $this->data['Formats'] = $formats;
        foreach ($formats as $i => $iValue) {
            $this->options['query']['Formats.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

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

    /**
     * @return $this
     */
    public function withWatermarks(array $watermarks)
    {
        $this->data['Watermarks'] = $watermarks;
        foreach ($watermarks as $depth1 => $depth1Value) {
            if (isset($depth1Value['Url'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Url'] = $depth1Value['Url'];
            }
            if (isset($depth1Value['Alpha'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Alpha'] = $depth1Value['Alpha'];
            }
            if (isset($depth1Value['Display'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Display'] = $depth1Value['Display'];
            }
            if (isset($depth1Value['X'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
            if (isset($depth1Value['Width'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Width'] = $depth1Value['Width'];
            }
            if (isset($depth1Value['Height'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Height'] = $depth1Value['Height'];
            }
            if (isset($depth1Value['ZOrder'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.ZOrder'] = $depth1Value['ZOrder'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withBackgrounds(array $backgrounds)
    {
        $this->data['Backgrounds'] = $backgrounds;
        foreach ($backgrounds as $depth1 => $depth1Value) {
            if (isset($depth1Value['Url'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Url'] = $depth1Value['Url'];
            }
            if (isset($depth1Value['Display'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Display'] = $depth1Value['Display'];
            }
            if (isset($depth1Value['X'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
            if (isset($depth1Value['Width'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Width'] = $depth1Value['Width'];
            }
            if (isset($depth1Value['Height'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Height'] = $depth1Value['Height'];
            }
            if (isset($depth1Value['ZOrder'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.ZOrder'] = $depth1Value['ZOrder'];
            }
        }

        return $this;
    }
}
