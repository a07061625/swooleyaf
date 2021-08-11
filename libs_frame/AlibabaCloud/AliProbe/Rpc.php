<?php

namespace AlibabaCloud\AliProbe;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'AliProbe';

    /** @var string */
    public $version = '2016-12-22';

    /** @var string */
    public $method = 'POST';
}
