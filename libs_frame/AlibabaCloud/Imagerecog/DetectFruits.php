<?php

namespace AlibabaCloud\Imagerecog;

/**
 * @method string getImageURL()
 */
class DetectFruits extends Rpc
{
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
