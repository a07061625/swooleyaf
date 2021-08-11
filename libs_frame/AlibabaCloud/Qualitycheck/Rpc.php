<?php

namespace AlibabaCloud\Qualitycheck;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Qualitycheck';

    /** @var string */
    public $version = '2019-01-15';

    /** @var string */
    public $method = 'POST';
}
