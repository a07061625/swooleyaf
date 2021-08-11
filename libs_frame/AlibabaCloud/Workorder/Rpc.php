<?php

namespace AlibabaCloud\Workorder;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Workorder';

    /** @var string */
    public $version = '2021-06-10';

    /** @var string */
    public $method = 'POST';
}
