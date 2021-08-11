<?php

namespace AlibabaCloud\Vpc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Vpc';

    /** @var string */
    public $version = '2016-04-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'vpc';
}
