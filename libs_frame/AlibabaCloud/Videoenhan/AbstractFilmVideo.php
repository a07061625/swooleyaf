<?php

namespace AlibabaCloud\Videoenhan;

/**
 * @method string getLength()
 * @method string getAsync()
 * @method string getVideoUrl()
 */
class AbstractFilmVideo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLength($value)
    {
        $this->data['Length'] = $value;
        $this->options['form_params']['Length'] = $value;

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
