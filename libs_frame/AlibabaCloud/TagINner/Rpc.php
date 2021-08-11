<?php

namespace AlibabaCloud\TagINner;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Tag-Inner';

    /** @var string */
    public $version = '2018-11-09';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'tag';
}
