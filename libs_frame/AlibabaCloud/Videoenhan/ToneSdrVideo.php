<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getRecolorModel()
 * @method string getBitrate()
 * @method string getAsync()
 * @method string getVideoURL()
 */
class ToneSdrVideo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRecolorModel($value)
    {
        $this->data['RecolorModel'] = $value;
        $this->options['form_params']['RecolorModel'] = $value;

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
