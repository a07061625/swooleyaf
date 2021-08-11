<?php

namespace AlibabaCloud\Imageseg;

/**
 * @method string getURL()
 */
class SegmentSkin extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withURL($value)
    {
        $this->data['URL'] = $value;
        $this->options['form_params']['URL'] = $value;

        return $this;
    }
}
