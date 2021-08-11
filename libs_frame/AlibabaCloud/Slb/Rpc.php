<?php

namespace AlibabaCloud\Slb;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Slb';

    /** @var string */
    public $version = '2014-05-15';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'slb';
}
