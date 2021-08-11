<?php

namespace AlibabaCloud\Sms;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Sms';

    /** @var string */
    public $version = '2016-09-27';

    /** @var string */
    public $method = 'POST';
}
