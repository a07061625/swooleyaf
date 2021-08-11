<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class VoiceAsyncManualScanResults extends Roa
{
    /** @var string */
    public $pathPattern = '/green/voice/manual/scan/results';

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
