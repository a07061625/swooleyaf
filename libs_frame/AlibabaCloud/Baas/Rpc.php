<?php

namespace AlibabaCloud\Baas;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Baas';

    /** @var string */
    public $version = '2018-07-31';

    /** @var string */
    public $method = 'POST';
}
