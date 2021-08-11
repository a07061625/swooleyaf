<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class ImageScanFeedback extends Roa
{
    /** @var string */
    public $pathPattern = '/green/image/feedback';

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
