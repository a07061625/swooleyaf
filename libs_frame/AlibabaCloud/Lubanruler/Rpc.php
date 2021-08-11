<?php

namespace AlibabaCloud\Lubanruler;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Lubanruler';

    /** @var string */
    public $version = '2017-12-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'lubanruler';
}
