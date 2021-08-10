<?php

namespace AlibabaCloud\Objectdet;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'objectdet';

    /** @var string */
    public $version = '2019-12-30';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'objectdet';
}
