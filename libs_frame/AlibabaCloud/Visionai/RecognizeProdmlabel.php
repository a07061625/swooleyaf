<?php

namespace AlibabaCloud\Visionai;

/**
 * @method string getImageUrl()
 */
class RecognizeProdmlabel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['form_params']['ImageUrl'] = $value;

        return $this;
    }
}
