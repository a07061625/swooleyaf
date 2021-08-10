<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method array getBoxes()
 * @method string getAsync()
 * @method string getJobId()
 * @method string getVideoUrl()
 */
class EraseLogoInVideo extends Rpc
{
    /**
     * @return $this
     */
    public function withBoxes(array $boxes)
    {
        $this->data['Boxes'] = $boxes;
        foreach ($boxes as $depth1 => $depth1Value) {
            if (isset($depth1Value['W'])) {
                $this->options['form_params']['Boxes.' . ($depth1 + 1) . '.W'] = $depth1Value['W'];
            }
            if (isset($depth1Value['H'])) {
                $this->options['form_params']['Boxes.' . ($depth1 + 1) . '.H'] = $depth1Value['H'];
            }
            if (isset($depth1Value['X'])) {
                $this->options['form_params']['Boxes.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['form_params']['Boxes.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAsync($value)
    {
        $this->data['Async'] = $value;
        $this->options['form_params']['Async'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobId($value)
    {
        $this->data['JobId'] = $value;
        $this->options['form_params']['JobId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoUrl($value)
    {
        $this->data['VideoUrl'] = $value;
        $this->options['form_params']['VideoUrl'] = $value;

        return $this;
    }
}
