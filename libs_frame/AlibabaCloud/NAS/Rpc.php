<?php

namespace AlibabaCloud\NAS;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'NAS';

    /** @var string */
    public $version = '2017-06-26';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'nas';
}
