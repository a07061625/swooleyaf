<?php

namespace AlibabaCloud\Afs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'afs';

    /** @var string */
    public $version = '2018-01-12';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'afs';
}
