<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getPrefix()
 */
class GetPreSignedUrl extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPrefix($value)
    {
        $this->data['Prefix'] = $value;
        $this->options['form_params']['Prefix'] = $value;

        return $this;
    }
}
