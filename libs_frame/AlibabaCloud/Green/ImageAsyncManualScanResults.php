<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class ImageAsyncManualScanResults extends Roa
{
    /** @var string */
    public $pathPattern = '/green/image/manual/scan/results';

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
