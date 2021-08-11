<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getName()
 * @method string getPageSize()
 * @method string getWord()
 * @method string getPageNumber()
 */
class ListUserAnalyzerEntries extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/user-analyzers/[name]/entries';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->pathParameters['name'] = $value;

        return $this;
    }

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
    public function withWord($value)
    {
        $this->data['Word'] = $value;
        $this->options['query']['word'] = $value;

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
