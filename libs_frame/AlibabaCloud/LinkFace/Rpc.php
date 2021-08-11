<?php

namespace AlibabaCloud\LinkFace;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'LinkFace';

    /** @var string */
    public $version = '2018-07-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    protected $scheme = 'https';
}
