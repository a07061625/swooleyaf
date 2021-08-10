<?php

namespace AlibabaCloud\Linkedmall;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'linkedmall';

    /** @var string */
    public $version = '2018-01-16';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'linkedmall';
}
