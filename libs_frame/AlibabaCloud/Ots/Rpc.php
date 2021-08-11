<?php

namespace AlibabaCloud\Ots;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ots';

    /** @var string */
    public $version = '2016-06-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ots';
}
