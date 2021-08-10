<?php

namespace AlibabaCloud\Iot;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Iot';

    /** @var string */
    public $version = '2018-01-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'iot';
}
