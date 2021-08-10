<?php

namespace AlibabaCloud\Cassandra;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Cassandra';

    /** @var string */
    public $version = '2019-01-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'Cassandra';
}
