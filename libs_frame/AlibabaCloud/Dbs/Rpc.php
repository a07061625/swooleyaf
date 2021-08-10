<?php

namespace AlibabaCloud\Dbs;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Dbs';

    /** @var string */
    public $version = '2019-03-06';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'cbs';
}
