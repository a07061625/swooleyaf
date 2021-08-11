<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class VoiceIdentityStartCheck extends Roa
{
    /** @var string */
    public $pathPattern = '/green/voice/auth/start/check';

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
