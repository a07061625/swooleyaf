<?php

namespace AlibabaCloud\Cloudgame;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'cloudgame';

    /** @var string */
    public $version = '2020-04-29';

    /** @var string */
    public $method = 'POST';
}
