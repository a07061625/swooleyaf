<?php

namespace AlibabaCloud\AmqpOpen;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'amqp-open';

    /** @var string */
    public $version = '2019-12-12';

    /** @var string */
    public $serviceCode = 'onsproxy';
}
