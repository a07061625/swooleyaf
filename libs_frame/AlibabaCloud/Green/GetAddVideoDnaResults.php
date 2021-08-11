<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class GetAddVideoDnaResults extends Roa
{
    /** @var string */
    public $pathPattern = '/green/video/dna/add/results';

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
