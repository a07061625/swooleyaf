<?php

namespace AlibabaCloud\UbsmsInner;

/**
 * @method string getUid()
 * @method $this withUid($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getServiceCode()
 * @method $this withServiceCode($value)
 * @method string getCallerBid()
 */
class DescribeUserBusinessStatus extends Rpc
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
