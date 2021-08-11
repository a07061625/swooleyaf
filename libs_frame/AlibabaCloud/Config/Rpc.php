<?php

namespace AlibabaCloud\Config;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Config';

    /** @var string */
    public $version = '2019-01-08';

    /** @var string */
    public $serviceCode = 'Config';
}
