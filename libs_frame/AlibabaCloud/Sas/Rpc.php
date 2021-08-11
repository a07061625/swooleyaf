<?php

namespace AlibabaCloud\Sas;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Sas';

    /** @var string */
    public $version = '2018-12-03';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'sas';
}
