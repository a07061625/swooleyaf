<?php

namespace AlibabaCloud\Cas;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'cas';

    /** @var string */
    public $version = '2018-08-13';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cas_esign_fdd';
}
