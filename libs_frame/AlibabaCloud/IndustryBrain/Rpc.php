<?php

namespace AlibabaCloud\IndustryBrain;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'industry-brain';

    /** @var string */
    public $version = '2019-06-30';

    /** @var string */
    public $method = 'POST';
}
