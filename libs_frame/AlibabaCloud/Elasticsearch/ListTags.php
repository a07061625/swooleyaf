<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getPageSize()
 * @method string getResourceType()
 */
class ListTags extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/tags/all-tags';

    /** @var string */
    public $method = 'GET';

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
    public function withResourceType($value)
    {
        $this->data['ResourceType'] = $value;
        $this->options['query']['resourceType'] = $value;

        return $this;
    }
}
