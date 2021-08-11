<?php

namespace AlibabaCloud\OnsMqtt;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'OnsMqtt';

    /** @var string */
    public $version = '2020-04-20';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'onsmqtt';
}
