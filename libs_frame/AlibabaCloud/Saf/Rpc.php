<?php

namespace AlibabaCloud\Saf;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'saf';

    /** @var string */
    public $version = '2019-05-21';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'saf';

    /** @var string */
    protected $scheme = 'https';
}
