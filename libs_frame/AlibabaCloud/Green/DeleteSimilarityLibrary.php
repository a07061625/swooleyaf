<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class DeleteSimilarityLibrary extends Roa
{
    /** @var string */
    public $pathPattern = '/green/similarity/library/delete';

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
