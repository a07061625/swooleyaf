<?php

namespace AlibabaCloud\Servicemesh;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'servicemesh';

    /** @var string */
    public $version = '2020-01-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'servicemesh';
}
