<?php

namespace AlibabaCloud\DmsEnterprise;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'dms-enterprise';

    /** @var string */
    public $version = '2018-11-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'dms-enterprise';
}
