<?php

namespace AlibabaCloud\Privatelink;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Privatelink';

    /** @var string */
    public $version = '2020-04-15';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'privatelink';

    /** @var string */
    protected $scheme = 'https';
}
