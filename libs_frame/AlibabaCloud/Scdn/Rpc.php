<?php

namespace AlibabaCloud\Scdn;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'scdn';

    /** @var string */
    public $version = '2017-11-15';

    /** @var string */
    public $method = 'POST';
}
