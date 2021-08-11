<?php

namespace AlibabaCloud\Actiontrail;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Actiontrail';

    /** @var string */
    public $version = '2020-07-06';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'actiontrail';
}
