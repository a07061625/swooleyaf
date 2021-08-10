<?php

namespace AlibabaCloud\Smc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'smc';

    /** @var string */
    public $version = '2019-06-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'smc';
}
