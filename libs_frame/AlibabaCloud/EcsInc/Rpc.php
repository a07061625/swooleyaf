<?php

namespace AlibabaCloud\EcsInc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'EcsInc';

    /** @var string */
    public $version = '2016-03-14';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ecs';
}
