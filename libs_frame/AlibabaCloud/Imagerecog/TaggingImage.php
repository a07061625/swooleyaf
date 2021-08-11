<?php

namespace AlibabaCloud\Imagerecog;

/**
 * @method string getMode()
 * @method string getImageType()
 * @method string getAsync()
 * @method string getImageURL()
 */
class TaggingImage extends Rpc
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
    public function withImageType($value)
    {
        $this->data['ImageType'] = $value;
        $this->options['form_params']['ImageType'] = $value;

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
    public function withImageURL($value)
    {
        $this->data['ImageURL'] = $value;
        $this->options['form_params']['ImageURL'] = $value;

        return $this;
    }
}
