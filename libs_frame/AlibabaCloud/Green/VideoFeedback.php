<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class VideoFeedback extends Roa
{
    /** @var string */
    public $pathPattern = '/green/video/feedback';

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
