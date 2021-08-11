<?php

namespace AlibabaCloud\Aegis;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'aegis';

    /** @var string */
    public $version = '2016-11-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'vipaegis';
}
