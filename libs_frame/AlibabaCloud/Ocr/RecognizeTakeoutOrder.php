<?php

namespace AlibabaCloud\Ocr;

/**
 * @method string getImageURL()
 */
class RecognizeTakeoutOrder extends Rpc
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
