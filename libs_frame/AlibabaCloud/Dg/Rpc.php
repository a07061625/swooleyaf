<?php

namespace AlibabaCloud\Dg;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'dg';

    /** @var string */
    public $version = '2019-03-27';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'dg';

    /** @var string */
    protected $scheme = 'https';
}
