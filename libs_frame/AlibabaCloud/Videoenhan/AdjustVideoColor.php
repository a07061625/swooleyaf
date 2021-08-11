<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getMode()
 * @method string getAsync()
 * @method string getVideoUrl()
 * @method string getVideoBitrate()
 * @method string getVideoCodec()
 * @method string getVideoFormat()
 */
class AdjustVideoColor extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMode($value)
    {
        $this->data['Mode'] = $value;
        $this->options['form_params']['Mode'] = $value;

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
    public function withVideoUrl($value)
    {
        $this->data['VideoUrl'] = $value;
        $this->options['form_params']['VideoUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoBitrate($value)
    {
        $this->data['VideoBitrate'] = $value;
        $this->options['form_params']['VideoBitrate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoCodec($value)
    {
        $this->data['VideoCodec'] = $value;
        $this->options['form_params']['VideoCodec'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoFormat($value)
    {
        $this->data['VideoFormat'] = $value;
        $this->options['form_params']['VideoFormat'] = $value;

        return $this;
    }
}
