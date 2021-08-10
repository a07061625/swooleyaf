<?php

namespace AlibabaCloud\Sts;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Sts';

    /** @var string */
    public $version = '2015-04-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    protected $scheme = 'https';
}
