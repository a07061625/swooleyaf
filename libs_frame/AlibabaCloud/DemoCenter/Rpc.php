<?php

namespace AlibabaCloud\DemoCenter;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'DemoCenter';

    /** @var string */
    public $version = '2020-01-21';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    protected $scheme = 'https';
}
