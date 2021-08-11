<?php

namespace AlibabaCloud\Ess;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Ess';

    /** @var string */
    public $version = '2014-08-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'ess';
}
