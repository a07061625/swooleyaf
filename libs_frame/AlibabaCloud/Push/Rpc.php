<?php

namespace AlibabaCloud\Push;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Push';

    /** @var string */
    public $version = '2016-08-01';

    /** @var string */
    public $method = 'POST';
}
