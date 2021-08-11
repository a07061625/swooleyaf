<?php

namespace AlibabaCloud\DBFS;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'DBFS';

    /** @var string */
    public $version = '2020-04-18';

    /** @var string */
    public $method = 'POST';
}
