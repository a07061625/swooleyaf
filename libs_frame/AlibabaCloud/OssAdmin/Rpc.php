<?php

namespace AlibabaCloud\OssAdmin;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'OssAdmin';

    /** @var string */
    public $version = '2015-05-20';

    /** @var string */
    public $method = 'POST';
}
