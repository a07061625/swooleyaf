<?php

namespace AlibabaCloud\Eci;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Eci';

    /** @var string */
    public $version = '2018-08-08';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'eci';
}
