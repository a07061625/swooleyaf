<?php

namespace AlibabaCloud\RKvstore;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'R-kvstore';

    /** @var string */
    public $version = '2015-01-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'redisa';
}
