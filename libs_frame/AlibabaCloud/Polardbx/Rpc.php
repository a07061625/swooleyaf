<?php

namespace AlibabaCloud\Polardbx;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'polardbx';

    /** @var string */
    public $version = '2020-02-02';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'polardbx';
}
