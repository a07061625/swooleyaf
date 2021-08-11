<?php

namespace AlibabaCloud\Imagerecog;

/**
 * @method string getUrl()
 */
class RecognizeImageStyle extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUrl($value)
    {
        $this->data['Url'] = $value;
        $this->options['form_params']['Url'] = $value;

        return $this;
    }
}
