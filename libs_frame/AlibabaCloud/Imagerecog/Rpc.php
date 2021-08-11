<?php

namespace AlibabaCloud\Imagerecog;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'imagerecog';

    /** @var string */
    public $version = '2019-09-30';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'imagerecog';
}
