<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class TextAsyncManualScanResults extends Roa
{
    /** @var string */
    public $pathPattern = '/green/text/manual/scan/results';

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
