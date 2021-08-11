<?php

namespace AlibabaCloud\Domain;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Domain';

    /** @var string */
    public $version = '2018-02-08';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'domain';
}
