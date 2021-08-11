<?php

namespace AlibabaCloud\WelfareInner;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'welfare-inner';

    /** @var string */
    public $version = '2018-05-24';

    /** @var string */
    public $method = 'POST';
}
