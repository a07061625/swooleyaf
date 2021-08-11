<?php

namespace AlibabaCloud\Imageaudit;

/**
 * @method array getScene()
 * @method array getTask()
 */
class ScanImage extends Rpc
{
    /**
     * @return $this
     */
    public function withScene(array $scene)
    {
        $this->data['Scene'] = $scene;
        foreach ($scene as $i => $iValue) {
            $this->options['form_params']['Scene.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTask(array $task)
    {
        $this->data['Task'] = $task;
        foreach ($task as $depth1 => $depth1Value) {
            if (isset($depth1Value['DataId'])) {
                $this->options['form_params']['Task.' . ($depth1 + 1) . '.DataId'] = $depth1Value['DataId'];
            }
            if (isset($depth1Value['ImageURL'])) {
                $this->options['form_params']['Task.' . ($depth1 + 1) . '.ImageURL'] = $depth1Value['ImageURL'];
            }
            if (isset($depth1Value['MaxFrames'])) {
                $this->options['form_params']['Task.' . ($depth1 + 1) . '.MaxFrames'] = $depth1Value['MaxFrames'];
            }
            if (isset($depth1Value['Interval'])) {
                $this->options['form_params']['Task.' . ($depth1 + 1) . '.Interval'] = $depth1Value['Interval'];
            }
            if (isset($depth1Value['ImageTimeMillisecond'])) {
                $this->options['form_params']['Task.' . ($depth1 + 1) . '.ImageTimeMillisecond'] = $depth1Value['ImageTimeMillisecond'];
            }
        }

        return $this;
    }
}
