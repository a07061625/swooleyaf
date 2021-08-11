<?php

namespace AlibabaCloud\Ga;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ga';

    /** @var string */
    public $version = '2019-11-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'gaplus';
}
