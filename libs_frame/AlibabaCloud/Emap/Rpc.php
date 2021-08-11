<?php

namespace AlibabaCloud\Emap;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'emap';

    /** @var string */
    public $version = '2020-10-10';

    /** @var string */
    public $method = 'POST';
}
