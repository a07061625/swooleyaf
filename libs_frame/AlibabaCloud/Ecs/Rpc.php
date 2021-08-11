<?php

namespace AlibabaCloud\Ecs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ecs';

    /** @var string */
    public $version = '2014-05-26';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ecs';
}
