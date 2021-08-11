<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getNumBoxes()
 * @method string getImageURL()
 */
class IntelligentComposition extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNumBoxes($value)
    {
        $this->data['NumBoxes'] = $value;
        $this->options['form_params']['NumBoxes'] = $value;

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
