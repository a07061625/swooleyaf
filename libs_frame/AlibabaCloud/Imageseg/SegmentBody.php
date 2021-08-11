<?php

namespace AlibabaCloud\Imageseg;

/**
 * @method string getReturnForm()
 * @method $this withReturnForm($value)
 * @method string getAsync()
 * @method string getImageURL()
 * @method $this withImageURL($value)
 */
class SegmentBody extends Rpc
{
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
}
