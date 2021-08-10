<?php

namespace AlibabaCloud\Live;

/**
 * @method array getBlendList()
 * @method string getCasterId()
 * @method $this withCasterId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getAudioLayer()
 * @method array getVideoLayer()
 * @method array getMixList()
 */
class AddCasterLayout extends Rpc
{
    /**
     * @return $this
     */
    public function withBlendList(array $blendList)
    {
        $this->data['BlendList'] = $blendList;
        foreach ($blendList as $i => $iValue) {
            $this->options['query']['BlendList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAudioLayer(array $audioLayer)
    {
        $this->data['AudioLayer'] = $audioLayer;
        foreach ($audioLayer as $depth1 => $depth1Value) {
            if (isset($depth1Value['VolumeRate'])) {
                $this->options['query']['AudioLayer.' . ($depth1 + 1) . '.VolumeRate'] = $depth1Value['VolumeRate'];
            }
            if (isset($depth1Value['ValidChannel'])) {
                $this->options['query']['AudioLayer.' . ($depth1 + 1) . '.ValidChannel'] = $depth1Value['ValidChannel'];
            }
            if (isset($depth1Value['FixedDelayDuration'])) {
                $this->options['query']['AudioLayer.' . ($depth1 + 1) . '.FixedDelayDuration'] = $depth1Value['FixedDelayDuration'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withVideoLayer(array $videoLayer)
    {
        $this->data['VideoLayer'] = $videoLayer;
        foreach ($videoLayer as $depth1 => $depth1Value) {
            if (isset($depth1Value['FillMode'])) {
                $this->options['query']['VideoLayer.' . ($depth1 + 1) . '.FillMode'] = $depth1Value['FillMode'];
            }
            if (isset($depth1Value['HeightNormalized'])) {
                $this->options['query']['VideoLayer.' . ($depth1 + 1) . '.HeightNormalized'] = $depth1Value['HeightNormalized'];
            }
            if (isset($depth1Value['WidthNormalized'])) {
                $this->options['query']['VideoLayer.' . ($depth1 + 1) . '.WidthNormalized'] = $depth1Value['WidthNormalized'];
            }
            if (isset($depth1Value['PositionRefer'])) {
                $this->options['query']['VideoLayer.' . ($depth1 + 1) . '.PositionRefer'] = $depth1Value['PositionRefer'];
            }
            foreach ($depth1Value['PositionNormalized'] as $i => $iValue) {
                $this->options['query']['VideoLayer.' . ($depth1 + 1) . '.PositionNormalized.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['FixedDelayDuration'])) {
                $this->options['query']['VideoLayer.' . ($depth1 + 1) . '.FixedDelayDuration'] = $depth1Value['FixedDelayDuration'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withMixList(array $mixList)
    {
        $this->data['MixList'] = $mixList;
        foreach ($mixList as $i => $iValue) {
            $this->options['query']['MixList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
