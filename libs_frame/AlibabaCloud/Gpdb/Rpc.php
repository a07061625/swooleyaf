<?php

namespace AlibabaCloud\Gpdb;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'gpdb';

    /** @var string */
    public $version = '2016-05-03';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'gpdb';
}
