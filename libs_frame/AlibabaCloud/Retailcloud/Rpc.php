<?php

namespace AlibabaCloud\Retailcloud;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'retailcloud';

    /** @var string */
    public $version = '2018-03-13';

    /** @var string */
    public $method = 'POST';
}
