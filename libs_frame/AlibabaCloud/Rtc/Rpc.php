<?php

namespace AlibabaCloud\Rtc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'rtc';

    /** @var string */
    public $version = '2018-01-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'rtc';
}
