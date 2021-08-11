<?php

namespace AlibabaCloud\Jaq;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'jaq';

    /** @var string */
    public $version = '2016-11-23';

    /** @var string */
    public $method = 'POST';
}
