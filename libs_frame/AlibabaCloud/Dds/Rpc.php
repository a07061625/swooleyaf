<?php

namespace AlibabaCloud\Dds;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Dds';

    /** @var string */
    public $version = '2015-12-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'Dds';
}
