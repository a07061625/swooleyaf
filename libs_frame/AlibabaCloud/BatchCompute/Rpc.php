<?php

namespace AlibabaCloud\BatchCompute;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'BatchCompute';

    /** @var string */
    public $version = '2016-11-11';

    /** @var string */
    public $method = 'POST';
}
