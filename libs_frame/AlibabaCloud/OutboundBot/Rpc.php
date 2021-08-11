<?php

namespace AlibabaCloud\OutboundBot;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'OutboundBot';

    /** @var string */
    public $version = '2019-12-26';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'outboundbot';
}
