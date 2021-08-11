<?php

namespace AlibabaCloud\Videosearch;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'videosearch';

    /** @var string */
    public $version = '2020-02-25';

    /** @var string */
    public $method = 'POST';
}
