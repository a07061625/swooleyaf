<?php

namespace AlibabaCloud\Companyreg;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'companyreg';

    /** @var string */
    public $version = '2019-05-08';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'companyreg';
}
