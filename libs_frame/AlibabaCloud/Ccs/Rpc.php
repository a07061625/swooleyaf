<?php

namespace AlibabaCloud\Ccs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ccs';

    /** @var string */
    public $version = '2017-10-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ccs';
}
