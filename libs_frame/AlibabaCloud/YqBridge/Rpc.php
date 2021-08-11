<?php

namespace AlibabaCloud\YqBridge;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'YqBridge';

    /** @var string */
    public $version = '2017-08-10';

    /** @var string */
    public $method = 'POST';
}
