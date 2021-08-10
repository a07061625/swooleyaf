<?php

namespace AlibabaCloud\Kms;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Kms';

    /** @var string */
    public $version = '2016-01-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'kms';

    /** @var string */
    protected $scheme = 'https';
}
