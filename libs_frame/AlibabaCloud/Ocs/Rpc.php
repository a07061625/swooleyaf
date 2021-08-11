<?php

namespace AlibabaCloud\Ocs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ocs';

    /** @var string */
    public $version = '2015-03-01';

    /** @var string */
    public $method = 'POST';
}
