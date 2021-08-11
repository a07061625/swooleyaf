<?php

namespace AlibabaCloud\Videorecog;

/**
 * @method string getIsGif()
 * @method string getAsync()
 * @method string getVideoUrl()
 */
class GenerateVideoCover extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsGif($value)
    {
        $this->data['IsGif'] = $value;
        $this->options['form_params']['IsGif'] = $value;

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
}
