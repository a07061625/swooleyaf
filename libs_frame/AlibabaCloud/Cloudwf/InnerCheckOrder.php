<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method string getData()
 */
class InnerCheckOrder extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withData($value)
    {
        $this->data['Data'] = $value;
        $this->options['query']['data'] = $value;

        return $this;
    }
}
