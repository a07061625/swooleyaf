<?php

namespace AlibabaCloud\Httpdns;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Httpdns';

    /** @var string */
    public $version = '2016-02-01';

    /** @var string */
    public $method = 'POST';
}
