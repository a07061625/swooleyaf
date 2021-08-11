<?php

namespace AlibabaCloud\Openanalytics;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'openanalytics';

    /** @var string */
    public $version = '2018-03-01';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'openanalytics';
}
