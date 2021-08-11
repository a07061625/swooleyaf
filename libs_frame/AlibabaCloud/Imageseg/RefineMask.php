<?php

namespace AlibabaCloud\Imageseg;

/**
 * @method string getMaskImageURL()
 * @method string getImageURL()
 */
class RefineMask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaskImageURL($value)
    {
        $this->data['MaskImageURL'] = $value;
        $this->options['form_params']['MaskImageURL'] = $value;

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
