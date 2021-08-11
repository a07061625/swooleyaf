<?php

namespace AlibabaCloud\VoiceNavigator;

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'VoiceNavigator';

    /** @var string */
    public $version = '2018-06-12';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'voicebot';
}
