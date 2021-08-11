<?php

namespace AlibabaCloud\Alimt;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'alimt';

    /** @var string */
    public $version = '2018-10-12';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'alimt';
}
