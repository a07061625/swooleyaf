<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class ListSimilarityLibraries extends Roa
{
    /** @var string */
    public $pathPattern = '/green/similarity/library/list';

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
