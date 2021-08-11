<?php

namespace AlibabaCloud\Oms;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Oms';

    /** @var string */
    public $version = '2015-02-12';

    /** @var string */
    public $method = 'POST';
}
