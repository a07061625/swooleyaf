<?php

namespace AlibabaCloud\Cdn;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Cdn';

    /** @var string */
    public $version = '2018-05-10';

    /** @var string */
    public $method = 'POST';
}
