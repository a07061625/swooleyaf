<?php

namespace AlibabaCloud\Xtrace;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'xtrace';

    /** @var string */
    public $version = '2019-08-08';

    /** @var string */
    public $method = 'POST';
}
