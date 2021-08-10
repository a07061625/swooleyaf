<?php

namespace AlibabaCloud\EmasAppmonitor;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'emas-appmonitor';

    /** @var string */
    public $version = '2019-06-11';

    /** @var string */
    public $method = 'POST';
}
