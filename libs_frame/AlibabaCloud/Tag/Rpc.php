<?php

namespace AlibabaCloud\Tag;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Tag';

    /** @var string */
    public $version = '2018-08-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'tag';
}
