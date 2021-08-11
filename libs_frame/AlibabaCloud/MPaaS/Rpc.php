<?php

namespace AlibabaCloud\MPaaS;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'mPaaS';

    /** @var string */
    public $version = '2019-08-21';

    /** @var string */
    public $method = 'POST';
}
