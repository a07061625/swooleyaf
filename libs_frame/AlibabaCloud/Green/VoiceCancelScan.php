<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class VoiceCancelScan extends Roa
{
    /** @var string */
    public $pathPattern = '/green/voice/cancelscan';

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
