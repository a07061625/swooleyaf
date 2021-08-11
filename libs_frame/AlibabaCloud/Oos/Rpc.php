<?php

namespace AlibabaCloud\Oos;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'oos';

    /** @var string */
    public $version = '2019-06-01';

    /** @var string */
    public $method = 'POST';
}
