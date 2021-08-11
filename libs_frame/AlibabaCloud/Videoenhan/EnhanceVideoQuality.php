<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getHDRFormat()
 * @method string getFrameRate()
 * @method string getMaxIlluminance()
 * @method string getBitrate()
 * @method string getOutPutWidth()
 * @method string getOutPutHeight()
 * @method string getAsync()
 * @method string getVideoURL()
 */
class EnhanceVideoQuality extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHDRFormat($value)
    {
        $this->data['HDRFormat'] = $value;
        $this->options['form_params']['HDRFormat'] = $value;

        return $this;
    }

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
    public function withMaxIlluminance($value)
    {
        $this->data['MaxIlluminance'] = $value;
        $this->options['form_params']['MaxIlluminance'] = $value;

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
    public function withOutPutWidth($value)
    {
        $this->data['OutPutWidth'] = $value;
        $this->options['form_params']['OutPutWidth'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOutPutHeight($value)
    {
        $this->data['OutPutHeight'] = $value;
        $this->options['form_params']['OutPutHeight'] = $value;

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
