<?php

namespace AlibabaCloud\NlpAutoml;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'nlp-automl';

    /** @var string */
    public $version = '2019-11-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'nlpautoml';
}
