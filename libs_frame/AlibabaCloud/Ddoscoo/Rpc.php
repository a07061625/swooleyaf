<?php

namespace AlibabaCloud\Ddoscoo;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'ddoscoo';

    /** @var string */
    public $version = '2020-01-01';

    /** @var string */
    public $method = 'POST';
}
