<?php

namespace AlibabaCloud\Eais;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'eais';

    /** @var string */
    public $version = '2019-06-24';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'eais';
}
