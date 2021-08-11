<?php

namespace AlibabaCloud\Hiknoengine;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'hiknoengine';

    /** @var string */
    public $version = '2019-06-25';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'hiknoengine';
}
