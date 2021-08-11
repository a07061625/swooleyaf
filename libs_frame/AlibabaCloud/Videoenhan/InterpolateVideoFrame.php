<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getFrameRate()
 * @method string getBitrate()
 * @method string getAsync()
 * @method string getVideoURL()
 */
class InterpolateVideoFrame extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFrameRate($value)
    {
        $this->data['FrameRate'] = $value;
        $this->options['form_params']['FrameRate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBitrate($value)
    {
        $this->data['Bitrate'] = $value;
        $this->options['form_params']['Bitrate'] = $value;

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
    public function withVideoURL($value)
    {
        $this->data['VideoURL'] = $value;
        $this->options['form_params']['VideoURL'] = $value;

        return $this;
    }
}
