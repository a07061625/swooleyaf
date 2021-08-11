<?php

namespace AlibabaCloud\Ubsms;

/**
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getCallerBid()
 */
class DescribeBusinessStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallerBid($value)
    {
        $this->data['CallerBid'] = $value;
        $this->options['query']['callerBid'] = $value;

        return $this;
    }
}
