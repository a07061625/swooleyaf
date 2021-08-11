<?php

namespace AlibabaCloud\Videoenhan;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'videoenhan';

    /** @var string */
    public $version = '2020-03-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'videoenhan';
}
