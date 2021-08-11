<?php

namespace AlibabaCloud\Live;

/**
 * @method array getEpisode()
 * @method string getCasterId()
 * @method $this withCasterId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class AddCasterProgram extends Rpc
{
    /**
     * @return $this
     */
    public function withEpisode(array $episode)
    {
        $this->data['Episode'] = $episode;
        foreach ($episode as $depth1 => $depth1Value) {
            if (isset($depth1Value['EpisodeType'])) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.EpisodeType'] = $depth1Value['EpisodeType'];
            }
            if (isset($depth1Value['EpisodeName'])) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.EpisodeName'] = $depth1Value['EpisodeName'];
            }
            if (isset($depth1Value['ResourceId'])) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.ResourceId'] = $depth1Value['ResourceId'];
            }
            foreach ($depth1Value['ComponentId'] as $i => $iValue) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.ComponentId.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['StartTime'])) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.StartTime'] = $depth1Value['StartTime'];
            }
            if (isset($depth1Value['EndTime'])) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.EndTime'] = $depth1Value['EndTime'];
            }
            if (isset($depth1Value['SwitchType'])) {
                $this->options['query']['Episode.' . ($depth1 + 1) . '.SwitchType'] = $depth1Value['SwitchType'];
            }
        }

        return $this;
    }
}
