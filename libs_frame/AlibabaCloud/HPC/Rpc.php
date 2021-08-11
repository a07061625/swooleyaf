<?php

namespace AlibabaCloud\HPC;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'HPC';

    /** @var string */
    public $version = '2016-12-13';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'hpc';
}
