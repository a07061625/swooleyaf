<?php

namespace AlibabaCloud\Tdsr;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'tdsr';

    /** @var string */
    public $version = '2020-01-01';

    /** @var string */
    public $method = 'POST';
}
