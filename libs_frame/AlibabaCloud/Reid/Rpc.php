<?php

namespace AlibabaCloud\Reid;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'reid';

    /** @var string */
    public $version = '2019-09-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = '1.1.8.2';
}
