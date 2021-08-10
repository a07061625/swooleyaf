<?php

namespace AlibabaCloud\Rtc;

/**
 * @method string getLayoutId()
 * @method $this withLayoutId($value)
 * @method array getPanes()
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getAudioMixCount()
 * @method $this withAudioMixCount($value)
 */
class ModifyMPULayout extends Rpc
{
    /**
     * @return $this
     */
    public function withPanes(array $panes)
    {
        $this->data['Panes'] = $panes;
        foreach ($panes as $depth1 => $depth1Value) {
            if (isset($depth1Value['PaneId'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.PaneId'] = $depth1Value['PaneId'];
            }
            if (isset($depth1Value['MajorPane'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.MajorPane'] = $depth1Value['MajorPane'];
            }
            if (isset($depth1Value['X'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
            if (isset($depth1Value['Width'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.Width'] = $depth1Value['Width'];
            }
            if (isset($depth1Value['Height'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.Height'] = $depth1Value['Height'];
            }
            if (isset($depth1Value['ZOrder'])) {
                $this->options['query']['Panes.' . ($depth1 + 1) . '.ZOrder'] = $depth1Value['ZOrder'];
            }
        }

        return $this;
    }
}
