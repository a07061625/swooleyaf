<?php

namespace AlibabaCloud\CCC;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'CCC';

    /** @var string */
    public $version = '2020-07-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'CCC';
}
