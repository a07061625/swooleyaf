<?php

namespace AlibabaCloud\Ivpd;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'ivpd';

    /** @var string */
    public $version = '2019-06-25';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ivpd';
}
