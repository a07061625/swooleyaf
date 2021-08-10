<?php

namespace AlibabaCloud\Eipanycast;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Eipanycast';

    /** @var string */
    public $version = '2020-03-09';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'eipanycast';
}
