<?php

namespace AlibabaCloud\PetaData;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'PetaData';

    /** @var string */
    public $version = '2016-01-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'petadata';
}
