<?php

namespace AlibabaCloud\DataworksPublic;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'dataworks-public';

    /** @var string */
    public $version = '2020-05-18';

    /** @var string */
    public $method = 'POST';
}
