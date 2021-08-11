<?php

namespace AlibabaCloud\Alb;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Alb';

    /** @var string */
    public $version = '2020-06-16';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'alb';
}
