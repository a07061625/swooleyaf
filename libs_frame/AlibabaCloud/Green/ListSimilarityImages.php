<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class ListSimilarityImages extends Roa
{
    /** @var string */
    public $pathPattern = '/green/similarity/image/list';

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
