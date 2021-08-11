<?php

namespace AlibabaCloud\Iqa;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'iqa';

    /** @var string */
    public $version = '2019-08-13';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'iqa';
}
