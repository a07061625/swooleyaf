<?php

namespace AlibabaCloud\Skyeye;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Skyeye';

    /** @var string */
    public $version = '2017-12-01';

    /** @var string */
    public $method = 'POST';
}
