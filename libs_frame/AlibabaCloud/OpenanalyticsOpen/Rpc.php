<?php

namespace AlibabaCloud\OpenanalyticsOpen;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'openanalytics-open';

    /** @var string */
    public $version = '2020-09-28';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'openanalytics';
}
