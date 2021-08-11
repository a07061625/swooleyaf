<?php

namespace AlibabaCloud\Bss;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Bss';

    /** @var string */
    public $version = '2014-07-14';

    /** @var string */
    public $method = 'POST';
}
