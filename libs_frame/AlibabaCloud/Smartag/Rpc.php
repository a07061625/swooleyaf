<?php

namespace AlibabaCloud\Smartag;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Smartag';

    /** @var string */
    public $version = '2018-03-13';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'smartag';
}
