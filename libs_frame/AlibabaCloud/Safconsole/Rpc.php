<?php

namespace AlibabaCloud\Safconsole;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'safconsole';

    /** @var string */
    public $version = '2021-01-12';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'safconsole';
}
