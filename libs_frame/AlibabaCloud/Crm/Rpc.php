<?php

namespace AlibabaCloud\Crm;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Crm';

    /** @var string */
    public $version = '2015-04-08';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'crm';
}
