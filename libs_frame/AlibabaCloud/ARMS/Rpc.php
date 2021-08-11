<?php

namespace AlibabaCloud\ARMS;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'ARMS';

    /** @var string */
    public $version = '2019-08-08';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'arms';
}
