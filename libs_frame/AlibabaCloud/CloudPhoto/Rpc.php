<?php

namespace AlibabaCloud\CloudPhoto;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'CloudPhoto';

    /** @var string */
    public $version = '2017-07-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cloudphoto';

    /** @var string */
    protected $scheme = 'https';
}
