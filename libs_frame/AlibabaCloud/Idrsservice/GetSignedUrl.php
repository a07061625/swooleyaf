<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getFileUrl()
 */
class GetSignedUrl extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileUrl($value)
    {
        $this->data['FileUrl'] = $value;
        $this->options['form_params']['FileUrl'] = $value;

        return $this;
    }
}
