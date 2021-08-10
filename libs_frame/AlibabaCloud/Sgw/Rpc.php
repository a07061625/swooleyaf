<?php

namespace AlibabaCloud\Sgw;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'sgw';

    /** @var string */
    public $version = '2018-05-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'hcs_sgw';
}
