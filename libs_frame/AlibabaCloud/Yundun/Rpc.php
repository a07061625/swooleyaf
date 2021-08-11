<?php

namespace AlibabaCloud\Yundun;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Yundun';

    /** @var string */
    public $version = '2015-02-27';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'yundun';
}
