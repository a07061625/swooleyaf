<?php

namespace AlibabaCloud\ITaaS;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'ITaaS';

    /** @var string */
    public $version = '2017-05-05';

    /** @var string */
    public $method = 'POST';
}
