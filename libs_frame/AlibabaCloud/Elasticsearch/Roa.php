<?php

namespace AlibabaCloud\Elasticsearch;

class Roa extends \AlibabaCloud\Client\Resolver\Roa
{
    /** @var string */
    public $product = 'elasticsearch';

    /** @var string */
    public $version = '2017-06-13';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'elasticsearch';
}
