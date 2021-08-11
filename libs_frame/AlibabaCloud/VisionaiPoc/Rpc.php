<?php

namespace AlibabaCloud\VisionaiPoc;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'visionai-poc';

    /** @var string */
    public $version = '2020-04-08';

    /** @var string */
    public $method = 'POST';
}
