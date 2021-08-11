<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getPageSize()
 * @method string getPageNumber()
 */
class ListUserAnalyzers extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/user-analyzers';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['pageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['query']['pageNumber'] = $value;

        return $this;
    }
}
