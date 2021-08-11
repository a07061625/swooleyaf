<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getTransitionStyle()
 * @method string getScene()
 * @method string getDuration()
 * @method string getPuzzleEffect()
 * @method string getHeight()
 * @method string getDurationAdaption()
 * @method array getFileList()
 * @method string getMute()
 * @method string getAsync()
 * @method string getSmartEffect()
 * @method string getWidth()
 * @method string getStyle()
 */
class GenerateVideo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTransitionStyle($value)
    {
        $this->data['TransitionStyle'] = $value;
        $this->options['form_params']['TransitionStyle'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScene($value)
    {
        $this->data['Scene'] = $value;
        $this->options['form_params']['Scene'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDuration($value)
    {
        $this->data['Duration'] = $value;
        $this->options['form_params']['Duration'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPuzzleEffect($value)
    {
        $this->data['PuzzleEffect'] = $value;
        $this->options['form_params']['PuzzleEffect'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHeight($value)
    {
        $this->data['Height'] = $value;
        $this->options['form_params']['Height'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDurationAdaption($value)
    {
        $this->data['DurationAdaption'] = $value;
        $this->options['form_params']['DurationAdaption'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withFileList(array $fileList)
    {
        $this->data['FileList'] = $fileList;
        foreach ($fileList as $depth1 => $depth1Value) {
            if (isset($depth1Value['FileName'])) {
                $this->options['form_params']['FileList.' . ($depth1 + 1) . '.FileName'] = $depth1Value['FileName'];
            }
            if (isset($depth1Value['FileUrl'])) {
                $this->options['form_params']['FileList.' . ($depth1 + 1) . '.FileUrl'] = $depth1Value['FileUrl'];
            }
            if (isset($depth1Value['Type'])) {
                $this->options['form_params']['FileList.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMute($value)
    {
        $this->data['Mute'] = $value;
        $this->options['form_params']['Mute'] = $value;

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
    public function withSmartEffect($value)
    {
        $this->data['SmartEffect'] = $value;
        $this->options['form_params']['SmartEffect'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWidth($value)
    {
        $this->data['Width'] = $value;
        $this->options['form_params']['Width'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStyle($value)
    {
        $this->data['Style'] = $value;
        $this->options['form_params']['Style'] = $value;

        return $this;
    }
}
