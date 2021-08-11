<?php

namespace AlibabaCloud\DomainIntl;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Domain-intl';

    /** @var string */
    public $version = '2017-12-18';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'domain';
}
