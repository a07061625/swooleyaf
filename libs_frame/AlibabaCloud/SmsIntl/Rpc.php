<?php

namespace AlibabaCloud\SmsIntl;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'sms-intl';

    /** @var string */
    public $version = '2018-05-01';

    /** @var string */
    public $method = 'POST';
}
