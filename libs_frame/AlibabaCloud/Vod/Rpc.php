<?php

namespace AlibabaCloud\Vod;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'vod';

    /** @var string */
    public $version = '2017-03-21';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'vod';
}
