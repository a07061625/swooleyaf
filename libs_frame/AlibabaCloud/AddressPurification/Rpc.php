<?php

namespace AlibabaCloud\AddressPurification;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'address-purification';

    /** @var string */
    public $version = '2019-11-18';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'addrp';
}
