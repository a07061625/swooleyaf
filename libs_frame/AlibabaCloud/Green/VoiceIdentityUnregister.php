<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class VoiceIdentityUnregister extends Roa
{
    /** @var string */
    public $pathPattern = '/green/voice/auth/unregister';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientInfo($value)
    {
        $this->data['ClientInfo'] = $value;
        $this->options['query']['ClientInfo'] = $value;

        return $this;
    }
}
