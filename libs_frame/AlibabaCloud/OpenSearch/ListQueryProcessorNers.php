<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getDomain()
 */
class ListQueryProcessorNers extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/query-processor/ner/default-priorities';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomain($value)
    {
        $this->data['Domain'] = $value;
        $this->options['query']['domain'] = $value;

        return $this;
    }
}
