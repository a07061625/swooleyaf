<?php

namespace AlibabaCloud\JarvisPublic;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'jarvis-public';

    /** @var string */
    public $version = '2018-06-21';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'jarvis-public';
}
