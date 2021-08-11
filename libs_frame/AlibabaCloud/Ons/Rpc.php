<?php

namespace AlibabaCloud\Ons;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ons';

    /** @var string */
    public $version = '2019-02-14';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ons';
}
