<?php

namespace AlibabaCloud\Scsp;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'scsp';

    /** @var string */
    public $version = '2020-07-02';

    /** @var string */
    public $method = 'POST';
}
