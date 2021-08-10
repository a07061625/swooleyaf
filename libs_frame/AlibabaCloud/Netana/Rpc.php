<?php

namespace AlibabaCloud\Netana;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Netana';

    /** @var string */
    public $version = '2018-10-18';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'Netana';
}
