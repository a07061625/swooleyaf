<?php

namespace AlibabaCloud\Aiccs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'aiccs';

    /** @var string */
    public $version = '2019-10-15';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'aiccs-service';
}
