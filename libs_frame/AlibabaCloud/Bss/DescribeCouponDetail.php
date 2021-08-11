<?php

namespace AlibabaCloud\Bss;

/**
 * @method string getCouponNumber()
 * @method $this withCouponNumber($value)
 */
class DescribeCouponDetail extends Rpc
{
    /** @var string */
    public $scheme = 'https';

    /** @var string */
    public $method = 'GET';
}
