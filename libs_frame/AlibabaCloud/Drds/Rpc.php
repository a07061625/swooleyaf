<?php

namespace AlibabaCloud\Drds;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Drds';

    /** @var string */
    public $version = '2019-01-23';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'drds';
}
