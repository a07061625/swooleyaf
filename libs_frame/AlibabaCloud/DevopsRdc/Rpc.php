<?php

namespace AlibabaCloud\DevopsRdc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'devops-rdc';

    /** @var string */
    public $version = '2020-03-03';

    /** @var string */
    public $method = 'POST';
}
