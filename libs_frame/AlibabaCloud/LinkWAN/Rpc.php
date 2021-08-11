<?php

namespace AlibabaCloud\LinkWAN;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'LinkWAN';

    /** @var string */
    public $version = '2018-12-30';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'linkwan';

    /** @var string */
    protected $scheme = 'https';
}
