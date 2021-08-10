<?php

namespace AlibabaCloud\SmartHosting;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'SmartHosting';

    /** @var string */
    public $version = '2020-08-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'smarthosting';
}
