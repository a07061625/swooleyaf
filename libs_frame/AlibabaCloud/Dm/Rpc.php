<?php

namespace AlibabaCloud\Dm;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Dm';

    /** @var string */
    public $version = '2015-11-23';

    /** @var string */
    public $method = 'POST';
}
