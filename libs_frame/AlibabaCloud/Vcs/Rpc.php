<?php

namespace AlibabaCloud\Vcs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Vcs';

    /** @var string */
    public $version = '2020-05-15';

    /** @var string */
    public $method = 'POST';
}
