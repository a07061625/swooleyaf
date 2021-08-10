<?php

namespace AlibabaCloud\Aliyuncvc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'aliyuncvc';

    /** @var string */
    public $version = '2020-03-30';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'aliyuncvc';
}
