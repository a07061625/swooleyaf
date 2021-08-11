<?php

namespace AlibabaCloud\Jarvis;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'jarvis';

    /** @var string */
    public $version = '2018-02-06';

    /** @var string */
    public $method = 'POST';
}
