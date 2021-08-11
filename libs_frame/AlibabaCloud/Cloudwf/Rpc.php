<?php

namespace AlibabaCloud\Cloudwf;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'cloudwf';

    /** @var string */
    public $version = '2017-03-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cloudwf';
}
