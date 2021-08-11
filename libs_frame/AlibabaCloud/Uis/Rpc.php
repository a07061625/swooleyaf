<?php

namespace AlibabaCloud\Uis;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Uis';

    /** @var string */
    public $version = '2018-08-21';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'uis';
}
