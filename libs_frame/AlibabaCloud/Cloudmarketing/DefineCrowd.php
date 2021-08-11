<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method string getRequestJsonData()
 */
class DefineCrowd extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRequestJsonData($value)
    {
        $this->data['RequestJsonData'] = $value;
        $this->options['form_params']['RequestJsonData'] = $value;

        return $this;
    }
}
