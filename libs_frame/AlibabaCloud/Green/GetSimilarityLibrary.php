<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class GetSimilarityLibrary extends Roa
{
    /** @var string */
    public $pathPattern = '/green/similarity/library/get';

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
