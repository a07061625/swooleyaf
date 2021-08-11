<?php

namespace AlibabaCloud\Ram;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ram';

    /** @var string */
    public $version = '2018-03-02';

    /** @var string */
    public $method = 'POST';
}
