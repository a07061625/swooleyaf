<?php

namespace AlibabaCloud\Geoip;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'geoip';

    /** @var string */
    public $version = '2020-01-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'geoip';
}
