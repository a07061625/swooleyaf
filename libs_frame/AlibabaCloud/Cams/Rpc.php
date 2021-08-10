<?php

namespace AlibabaCloud\Cams;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'cams';

    /** @var string */
    public $version = '2020-06-06';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cams';
}
