<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method string getUrl()
 */
class MakeSuperResolutionImage extends Rpc
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
