<?php

namespace AlibabaCloud\Visionai;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'visionai';

    /** @var string */
    public $version = '2019-10-24';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'visionai';
}
