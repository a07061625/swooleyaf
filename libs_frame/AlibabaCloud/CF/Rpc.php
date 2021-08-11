<?php

namespace AlibabaCloud\CF;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'CF';

    /** @var string */
    public $version = '2015-11-27';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cf';

    /** @var string */
    protected $scheme = 'https';
}
