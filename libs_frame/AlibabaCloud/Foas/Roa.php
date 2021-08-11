<?php

namespace AlibabaCloud\Foas;

class Roa extends \AlibabaCloud\Client\Resolver\Roa
{
    /** @var string */
    public $product = 'foas';

    /** @var string */
    public $version = '2018-11-11';

    /** @var string */
    public $serviceCode = 'foas';

    /** @var string */
    protected $scheme = 'https';
}
