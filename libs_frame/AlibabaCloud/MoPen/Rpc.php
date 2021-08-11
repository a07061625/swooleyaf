<?php

namespace AlibabaCloud\MoPen;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'MoPen';

    /** @var string */
    public $version = '2018-02-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'mopen';

    /** @var string */
    protected $scheme = 'https';
}
