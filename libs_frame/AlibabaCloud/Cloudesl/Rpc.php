<?php

namespace AlibabaCloud\Cloudesl;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'cloudesl';

    /** @var string */
    public $version = '2020-02-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cloudesl';
}
