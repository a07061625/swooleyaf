<?php

namespace AlibabaCloud\Vs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'vs';

    /** @var string */
    public $version = '2018-12-12';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'vs';
}
