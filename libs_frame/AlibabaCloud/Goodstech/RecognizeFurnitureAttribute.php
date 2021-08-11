<?php

namespace AlibabaCloud\Goodstech;

/**
 * @method string getImageURL()
 */
class RecognizeFurnitureAttribute extends Rpc
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
