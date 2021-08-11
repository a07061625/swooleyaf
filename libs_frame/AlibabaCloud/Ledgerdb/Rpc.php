<?php

namespace AlibabaCloud\Ledgerdb;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'ledgerdb';

    /** @var string */
    public $version = '2019-11-22';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ledgerdb';
}
