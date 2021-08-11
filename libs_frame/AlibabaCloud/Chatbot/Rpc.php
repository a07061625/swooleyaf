<?php

namespace AlibabaCloud\Chatbot;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Chatbot';

    /** @var string */
    public $version = '2017-10-11';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'beebot';
}
