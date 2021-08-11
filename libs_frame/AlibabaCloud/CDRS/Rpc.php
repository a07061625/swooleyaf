<?php

namespace AlibabaCloud\CDRS;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'CDRS';

    /** @var string */
    public $version = '2020-11-01';

    /** @var string */
    public $method = 'POST';
}
