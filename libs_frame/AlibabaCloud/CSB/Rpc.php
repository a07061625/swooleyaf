<?php

namespace AlibabaCloud\CSB;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'CSB';

    /** @var string */
    public $version = '2017-11-18';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    protected $scheme = 'https';
}
